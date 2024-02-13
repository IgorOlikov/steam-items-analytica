<?php

namespace App\Services;

use App\Models\RefreshSession;
use App\Models\User;
use Carbon\FactoryImmutable;
use DateTimeImmutable;
use Faker\Provider\Uuid;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Lcobucci\JWT\Validation\Validator;

class TokenService
{
    protected Builder $tokenBuilder;
    protected Hmac $algorithm;
    protected InMemory $signingKey;
    protected FactoryImmutable $clock;
    protected Validator $validator;
    protected Parser $parser;
    private DateTimeImmutable $now;


    public function __construct()
    {
        $this->now          = new DateTimeImmutable();
        $this->tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $this->algorithm    = new Sha256();
        $this->signingKey   = InMemory::plainText(config('app.secret_key'));
        $this->clock        = new FactoryImmutable();
        $this->validator    = new Validator();
        $this->parser       = new Parser(new JoseEncoder());
    }

    public function getTokens(User $user, $ip , $userAgent) : array
    {
        $accessToken = $this->generateAccessToken($user);

        $refreshToken = $this->generateRefreshToken($user, $ip, $userAgent);

        return [
            'access_token' => $accessToken->toString(),
            'refresh_token' => $refreshToken->toString(),
         ];
    }

    public function generateAccessToken(User $user): UnencryptedToken
    {
        return $this->tokenBuilder
            // the issuer (iss claim)
            ->issuedBy(config('app.url'))
            //  user id
            ->withClaim('uuid', $user->id)
            // subject of the token (sub claim)
            ->relatedTo('user')
            // time that the token was issue (iat claim)
            ->issuedAt($this->now)
            // time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($this->now->modify('+1 minute'))
            //(exp claim)
            ->expiresAt($this->now->modify('+1 hour'))
            ->getToken($this->algorithm, $this->signingKey);
    }

    public function generateRefreshToken(User $user, $userAgent ,$ip): UnencryptedToken
    {
        $refreshTokenId = Uuid::uuid();

        $refreshToken = $this->tokenBuilder
            // the issuer (iss claim)
            ->issuedBy(config('app.url'))
            //user id
            ->withClaim('uuid', $user->id)
            //jti claim
            ->identifiedBy($refreshTokenId)
            // subject of the token (sub claim)
            ->relatedTo('user')
            // time that the token was issue (iat claim)
            ->issuedAt($this->now)
            // time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($this->now->modify('+1 minute'))
            // expiration time of the token (exp claim)
            ->expiresAt($this->now->modify('+1 month'))
            ->getToken($this->algorithm, $this->signingKey);

        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $user->id,
            'refresh_token' => $refreshToken->toString(),
            'user_agent' => $userAgent,
            'ip' => $ip,
            'expires_in' => $this->now->modify('+1 month'),
        ]);

        return $refreshToken;
    }

    public function validateAccessToken(string $token): array|string|bool
    {
        try {
            $token = $this->parser->parse($token);
        } catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
            echo 'Oh no, an error: ' . $e->getMessage();
        }

        if(!assert($token instanceof UnencryptedToken)){
            $message = ['message' => 'invalid token'];
        } elseif (!$this->validator->validate($token, new SignedWith($this->algorithm, $this->signingKey))){
            $message = ['message' => 'invalid token'];
        } elseif (!$this->validator->validate($token, new StrictValidAt($this->clock))) {
            $message = ['message' => 'token has expired'];
        } else {
            $message = true;
        }

        return $message;

    }

    public function validateRefreshToken(string $token): array|string|bool
    {
        try {
            $token = $this->parser->parse($token);
        } catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
            echo 'Oh no, an error: ' . $e->getMessage();
        }

        if(!assert($token instanceof UnencryptedToken)){
            $message = ['message' => 'invalid token'];
        } elseif (!$this->validator->validate($token, new SignedWith($this->algorithm, $this->signingKey))){
            $message = ['message' => 'invalid token'];
        } elseif (!$this->validator->validate($token, new StrictValidAt($this->clock))) {
            $message = ['message' => 'token has expired'];
        } else {
            $message = true;
        }

        return $message;
    }

    public function getTokenUser($token): User
    {
       $token = $this->parser->parse($token);

       $userId = $token->claims()->get('uuid');

        return User::find($userId);
    }


}
