<?php

namespace App\Contracts;

use App\Models\User;
use Tymon\JWTAuth\Payload;
use Tymon\JWTAuth\Token;

interface JwtAuthServiceInterface
{
    public function createAccessToken(User $user, int $roleId = 2): string;

    public function createRefreshToken(User $user,string $userAgent,string $ip, int $roleId = 2): string;

    public function createRefreshSession(
        string $refreshTokenId,
        string $userId,
        string $refreshToken,
        string $userAgent,
        string $ip
    ): void;

    public function createTokenPair(
        User $user,
        string $oldRefreshToken,
        string $oldRefreshTokenId,
        string $userAgent,
        string $ip
    ): array;

    public function deleteRefreshSession(string $refreshTokenId): void;

    public function getPayloadFromToken(string $token): Payload;

    public function invalidateToken(string $token): void;

    public function getTokenIdFromPayload(Payload $payload): string;
}
