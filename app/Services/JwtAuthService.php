<?php

namespace App\Services;

use App\Contracts\JwtAuthServiceInterface;
use App\Models\RefreshSession;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Payload;
use Tymon\JWTAuth\Token;

class JwtAuthService implements JwtAuthServiceInterface
{

    public function createAccessToken(User $user, int $roleId = 2): string
    {
        return auth()
            ->setTTL(config('jwt.ttl'))
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token',
                'role_id' => $roleId,
            ])
            ->login($user);
    }

    public function createRefreshToken(User $user, string $userAgent, string $ip, int $roleId = 2): string
    {
        $refreshToken = auth()
            ->setTTL(config('jwt.refresh_ttl'))
            ->claims([
                'jti' => $refreshTokenId = Uuid::uuid(),
                'token_type' => 'refresh_token',   //custom claims model
                'role_id' => $roleId,
            ])
            ->login($user);

        $this->createRefreshSession($refreshTokenId, $user->id, $refreshToken, $userAgent, $ip);

        return $refreshToken;
    }

    public function createTokenPair(
        User $user,
        string $oldRefreshToken,
        string $oldRefreshTokenId,
        string $userAgent,
        string $ip
    ): array
    {
        $newAccessToken = auth()
            ->setTTL(config('jwt.ttl'))
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token',
                'role_id' => $user->role_id,
            ])
            ->login($user);

        $newRefreshToken = auth()
            ->setTTL(config('jwt.refresh_ttl'))
            ->claims([
                'jti' => $newRefreshTokenId = Uuid::uuid(),
                'token_type' => 'refresh_token',
                'role_id' => $user->role_id,
            ])
            ->login($user);

        $this->invalidateToken($oldRefreshToken);

        $this->deleteRefreshSession($oldRefreshTokenId);

        $this->createRefreshSession($newRefreshTokenId, $user->id, $newRefreshToken, $userAgent, $ip);

        return [$newAccessToken, $newRefreshToken];
    }

    public function createRefreshSession(
        string $refreshTokenId,
        string $userId,
        string $refreshToken,
        string $userAgent,
        string $ip
    ): void
    {
        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $userId,
            'refresh_token' => $refreshToken,
            'expires_in' => Carbon::now(config('app.server_timezone'))
                ->addMinutes(config('jwt.refresh_ttl')),
            'user_agent' => $userAgent,
            'ip' => $ip,
        ]);
    }

    public function deleteRefreshSession(string $refreshTokenId): void
    {
        if(RefreshSession::find($refreshTokenId)->exists()) {
            RefreshSession::find($refreshTokenId)->delete();
        }
    }

    public function getPayloadFromToken(string $token): Payload
    {
        return JWTAuth::manager()->decode(new Token($token));
    }

    public function invalidateToken(string $token): void
    {
        JWTAuth::manager()->invalidate(new Token($token), true);
    }

    public function getTokenIdFromPayload(Payload $payload): string
    {
        return $payload->get('jti');
    }




}
