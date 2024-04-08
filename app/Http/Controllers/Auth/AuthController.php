<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\JwtAuthServiceInterface;
use App\Http\Controllers\Controller;
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
                //'/api/v1/auth'
        $cookie = Cookie::make('token', $refreshToken, (string)config('jwt.refresh_ttl'), '/', 'localhost', false, false);

        return response([
            'message' => 'User created successfully, check your email',
            'access_token' => $accessToken,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => 2,
                'email_verified' => ($user->email_verified_at !== null),
                'cart_id' => $user->cart_id,
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

        $cookie = Cookie::make('token', $refreshToken, (string)config('jwt.refresh_ttl'),'/','localhost', false, false);

        return response([
            'message' => 'Successfully, log in',
            'access_token' => $accessToken,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'email_verified' => ($user->email_verified_at !== null),
                'cart_id' => $user->cart->id,
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
        $cookie = Cookie::make('token', '', time() - 3600, '/', 'localhost', false, false);

        return response(['message' => 'Successfully logged out'],200)->withCookie($cookie);
    }

    public function refreshTokens(RefreshTokensRequest $request)
    {
        $user = auth()->user();

        $oldRefreshToken = $request->cookie('token');

        $oldRefreshTokenId = auth()->payload()->get('jti');

        [$newAccessToken, $newRefreshToken] = $this->jwtAuthService
            ->createTokenPair($user, $oldRefreshToken, $oldRefreshTokenId, $request->userAgent(), $request->ip());

        //data format!!! check // httponly true potom
        $cookie = Cookie::make('token', $newRefreshToken, (string)config('jwt.refresh_ttl'), '/','localhost',false,false);

        return response([
            'message' => 'Successfully, refreshed',
            'access_token' => $newAccessToken,
            'expires_in' => config('jwt.ttl') * 60,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'email_verified' => ($user->email_verified_at !== null),
                ]
        ],200)->withCookie($cookie);
    }
}
