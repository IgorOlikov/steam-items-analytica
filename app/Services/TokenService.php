<?php

namespace App\Services;

use App\Models\RefreshSession;
use App\Models\User;
use DateTimeImmutable;
use Faker\Provider\Uuid;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\UnencryptedToken;

class TokenService
{
    protected Builder $tokenBuilder;
    protected Hmac $algorithm;
    protected InMemory $signingKey;
    private DateTimeImmutable $now;

    public function __construct()
    {
        $this->now          = new DateTimeImmutable();
        $this->tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $this->algorithm    = new Sha256();
        $this->signingKey   = InMemory::plainText(config('app.secret_key'));
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

    public function validateAccessToken()
    {

    }

    public function validateRefreshToken()
    {

    }


}
