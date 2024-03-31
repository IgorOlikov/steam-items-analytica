<?php

namespace App\Http\Controllers;

use App\Contracts\JwtAuthServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RefreshTokensRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendEmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function __construct(
        protected JwtAuthServiceInterface $jwtAuthService
    )
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        //send email notification - job
        dispatch(new SendEmailVerification($user));

        $accessToken = $this->jwtAuthService
            ->createAccessToken($user);

        $refreshToken = $this->jwtAuthService
            ->createRefreshToken($user, $request->userAgent(), $request->ip());

        $cookie = Cookie::make('token', $refreshToken, (string)config('jwt.refresh_ttl'), '/api/v1/auth', 'localhost', true, false);

        return response([
            'message' => 'User created successfully, check your email',
            'access_token' => $accessToken,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => 2,
            ],
        ], 201)->withCookie($cookie);
    }

    public function login(LoginRequest $request)
    {
        if(! auth()->attempt($request->validated())) {
            return response([
                'message' => 'The provided credentials do not match our records',
                ],400);
        }

        $user = $request->user();

        $accessToken = $this->jwtAuthService->createAccessToken($user, $user->role_id);

        $refreshToken = $this->jwtAuthService
            ->createRefreshToken($user, $request->userAgent(), $request->ip(), $user->role_id);

        $cookie = Cookie::make('token', $refreshToken, (string)config('jwt.refresh_ttl'),'/api/v1/auth','localhost', true, false);

        return response([
            'message' => 'Successfully, log in',
            'access_token' => $accessToken,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                ]
        ],200)->withCookie($cookie);
    }
    public function logout(LogoutRequest $request)
    {
        $refreshToken = $request->cookie('token');

        $payload = $this->jwtAuthService->getPayloadFromToken($refreshToken);

        $refreshTokenId = $this->jwtAuthService->getTokenIdFromPayload($payload);

        $this->jwtAuthService->deleteRefreshSession($refreshTokenId);

        //refresh token to blacklist
       $this->jwtAuthService->invalidateToken($refreshToken);

        //access token to blacklist
        auth()->logout();

        //delete old cookie
        $cookie = Cookie::make('token', '', time() - 3600, '/api/v1/auth', 'localhost', true, false);

        return response(['message' => 'Successfully logged out'],200)->withCookie($cookie);
    }

    public function refreshTokens(RefreshTokensRequest $request)
    {
        $user = auth()->user();

        //fetch refresh token from request
        $payload = auth()->payload();

        //get token old id
        $oldRefreshTokenId = $payload->get('jti');

        $newAccessToken = $this->jwtAuthService
            ->createAccessToken($user, $user->role_id);

        $newRefreshToken = $this->jwtAuthService
              ->refreshRefreshToken($user, $oldRefreshTokenId, $request->userAgent(), $request->ip());

        $cookie = Cookie::make('token', $newRefreshToken, (string)config('jwt.refresh_ttl'), '/api/v1/auth','localhost',true,false);

        return response([
            'message' => 'Successfully, refreshed',
            'access_token' => $newAccessToken,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                ]
        ],200)->withCookie($cookie);
    }
}
