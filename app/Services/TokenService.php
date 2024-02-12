<?php

namespace App\Services;

use App\Models\RefreshSession;
use App\Models\User;
use DateTimeImmutable;
use Faker\Provider\Uuid;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;

class TokenService
{

    public function getTokens(User $user, $ip , $userAgent) : array
    {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm    = new Sha256();
        $signingKey   = InMemory::plainText(env('SECRET_KEY'));


        $now   = new DateTimeImmutable();
        $accessToken = $tokenBuilder
            // Configures the issuer (iss claim)
            ->issuedBy(env('APP_URL'))
            //user id
            ->withClaim('uuid', $user->id)
            // Configures the subject of the token (sub claim)
            ->relatedTo('user')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify('+1 minute'))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+1 hour'))
            // Builds a new token
            ->getToken($algorithm, $signingKey);

        $refreshTokenId = Uuid::uuid();


        $refreshToken = $tokenBuilder
            // Configures the issuer (iss claim)
            ->issuedBy(env('APP_URL'))
            //user id
            ->withClaim('uuid', $user->id)
            //jti claim
            ->identifiedBy($refreshTokenId)
            // Configures the subject of the token (sub claim)
            ->relatedTo('user')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify('+1 minute'))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+1 month'))
            // Builds a new token
            ->getToken($algorithm, $signingKey);
        dd($now->modify('+1 month')); // database time
      //RefreshSession::create([
      //    'id' => $refreshTokenId,
      //    'user_id' => $user->id,
      //    'refresh_token' => $refreshToken->toString(),
      //    'user_agent' => $userAgent,
      //    'ip' => $ip,
      //    'expires_in' => $now->modify('+1 month'),
      //    ]);

       $tokens = [
           'access_token' => $accessToken->toString(),
           'refresh_token' => $refreshToken->toString(),
        ];

       return $tokens;
    }


}
