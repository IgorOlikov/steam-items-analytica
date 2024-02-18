<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RefreshTokensRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendEmailVerification;
use App\Models\RefreshSession;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create($credentials);

        $accessToken = auth()
            ->setTTL(60)
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token'
            ])
            ->login($user);

        //send email job
        dispatch(new SendEmailVerification($user));

        //$name = null, $value = null, $minutes = 0, $path = null, $domain = null,
        // $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
        $accessToken = 'Bearer' . ' ' . $accessToken;

        return response([
            'message' => 'User created successfully, check your email'
        ], 201)->withCookie($accessToken)
            ->cookie('token',
                $accessToken,
                '60',
                '/api/v1/auth'
                ,'localhost'
                ,false,false);
    }

    public function login(LoginRequest $request)
    {
        if(! auth()->attempt($request->validated())){
            return response(['message' => 'The provided credentials do not match our records']);
        }
        $user = $request->user();

        $accessToken = auth()
            ->setTTL(60)
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token'
                ])
            ->login($user);

        $refreshToken = auth()
            ->setTTL(43800)
            ->claims([
                'jti' => $refreshTokenId = Uuid::uuid(),
                'token_type' => 'refresh_token'
            ])
            ->login($user);

        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $user->id,
            'refresh_token' => $refreshToken,
            'expires_in' => Carbon::now(5)->addMinutes(43800),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
            ]);

        $accessToken = 'Bearer' . ' ' . $accessToken;

        return response([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ],200)
            ->cookie('token',
                $accessToken,
                '60',
                '/api/v1/auth'
                ,'localhost'
                ,false,false);
    }
    public function logout(LogoutRequest $request)
    {
        $tokens = $request->validated();

        $payload = JWTAuth::manager()->decode(new Token($tokens['refresh_token']));

        $refreshTokenId = $payload->get('jti');

        if(RefreshSession::find($refreshTokenId)->exists()){
            RefreshSession::find($refreshTokenId)->delete();
        }

        //refresh token invalidate(to blacklist)
        JWTAuth::manager()->invalidate(new Token($tokens['refresh_token']), true);

        //access token invalidate(to blacklist)
        auth()->logout();

        return response(['message' => 'Successfully logged out'],200);
    }

    public function refreshTokens(RefreshTokensRequest $request)
    {
        //accepts refresh token from request
        $payload = auth()->payload();

        $refreshTokenId = $payload->get('jti');

        $user = auth()->user();

        if(RefreshSession::find($refreshTokenId)->exists()){
            RefreshSession::find($refreshTokenId)->delete();
        }
        //create new Refresh token , old blacklisted
        $newRefreshToken = auth()
           ->setTTL(43800)
           ->claims([
               'jti' => $refreshTokenId = Uuid::uuid()
           ])
           ->refresh(true,false);

        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $user->id,
            'refresh_token' => $newRefreshToken,
            'expires_in' => Carbon::now(5)->addMinutes(43800),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
        ]);

        //create new Access token
        $newAccessToken = auth()
            ->setTTL(60)
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token'
            ])
            ->login($user);

        $newAccessToken = 'Bearer' . ' ' . $newAccessToken;

        return response([
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken
        ],200)
            ->cookie('token',
                $newAccessToken,
                '60',
                '/api/v1/auth'
                ,'localhost'
                ,false,false);
    }
}
