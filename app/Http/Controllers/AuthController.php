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
use Illuminate\Http\Request;
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
        $user = User::create($request->validated());

        //send email notification - job
        dispatch(new SendEmailVerification($user));

        $accessToken = auth()
            ->setTTL(config('jwt.ttl'))
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token',
                'role_id' => 2,
            ])
            ->login($user);

        $refreshToken = auth()
            ->setTTL(config('jwt.refresh_ttl'))
            ->claims([
                'jti' => $refreshTokenId = Uuid::uuid(),
                'token_type' => 'refresh_token',   //custom claims model
                'role_id' => 2,
            ])
            ->login($user);

        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $user->id,
            'refresh_token' => $refreshToken,
            'expires_in' => Carbon::now(config('app.server_timezone'))
                ->addMinutes(config('jwt.refresh_ttl')),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
        ]);


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
        ], 201)
            ->cookie('token',
                $refreshToken,
                (string)config('jwt.refresh_ttl'),
                '/api/v1/auth',
                'localhost',
                true,
                false);

        /*
         *  set httpOnly Cookie
         *  $name = null, $value = null, $minutes = 0, $path = null, $domain = null,
         *  $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
         */
    }

    public function login(LoginRequest $request)
    {
        if(! auth()->attempt($request->validated())) {
            return response([
                'message' => 'The provided credentials do not match our records',
                ],400);
        }
        $user = $request->user();

        $accessToken = auth()
            ->setTTL(config('jwt.ttl'))
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token',
                'role_id' => $user->role_id,
                ])
            ->login($user);

        $refreshToken = auth()
            ->setTTL(config('jwt.refresh_ttl'))
            ->claims([
                'jti' => $refreshTokenId = Uuid::uuid(),
                'token_type' => 'refresh_token',
                'role_id' => $user->role_id,
            ])
            ->login($user);

        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $user->id,
            'refresh_token' => $refreshToken,
            'expires_in' => Carbon::now(config('app.server_timezone'))
                ->addMinutes(config('jwt.refresh_ttl')),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
            ]);

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
        ],200)
            ->cookie('token',                    //name
                $refreshToken,                          //value
                (string)config('jwt.refresh_ttl'), //expires
                '/api/v1/auth',                          //domain
                'localhost',                            //path
                true,                                 //httpOnly-true(no javascript access)
                false);              //<---            //secure-if TRUE 'ONLY httpS conn'!!!!!
    }
    public function logout(LogoutRequest $request)
    {
        $refreshToken = $request->cookie('token');

        $payload = JWTAuth::manager()->decode(new Token($refreshToken));

        $refreshTokenId = $payload->get('jti');

        if(RefreshSession::find($refreshTokenId)->exists()){
            RefreshSession::find($refreshTokenId)->delete();
        }

        //refresh token invalidate(to blacklist)
        JWTAuth::manager()->invalidate(new Token($refreshToken), true);

        //access token invalidate(to blacklist)
        auth()->logout();

        /*
         * "delete" old cookie
         */
        return response(['message' => 'Successfully logged out'],200)
            ->cookie('token',
                '',
                time() - 3600,
                '/api/v1/auth',
                'localhost',
                true,
                false);
    }

    public function refreshTokens(RefreshTokensRequest $request) //RefreshTokensRequest
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
           ->setTTL(config('jwt.refresh_ttl'))
           ->claims([
               'jti' => $refreshTokenId = Uuid::uuid(),
               'role_id' => $user->role_id,
           ])
           ->refresh(true,false);

        //create new Access token
        $newAccessToken = auth()
            ->setTTL(config('jwt.ttl'))
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token',
                'role_id' => $user->role_id,
            ])
            ->login($user);

        RefreshSession::create([
            'id' => $refreshTokenId,
            'user_id' => $user->id,
            'refresh_token' => $newRefreshToken,
            'expires_in' => Carbon::now(config('app.server_timezone'))
                ->addMinutes(config('jwt.refresh_ttl')),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
        ]);

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
        ],200)
            ->cookie('token',
                $newRefreshToken,
                (string)config('jwt.refresh_ttl'),
                '/api/v1/auth'
                ,'localhost'
                ,true,false);
    }
}
