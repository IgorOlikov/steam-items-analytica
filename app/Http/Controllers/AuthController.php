<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokensRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\RefreshSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Faker\Provider\Uuid;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(RegisterRequest $request)
    {

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

        return response([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ],200);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refreshTokens(RefreshTokensRequest $request)
    {
        $payload = auth()->payload();

        $refreshTokenId = $payload->get('jti');

        $user = auth()->user();

        if(RefreshSession::find($refreshTokenId)->exists()){
            RefreshSession::find($refreshTokenId)->delete();
        }

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

        $newAccessToken = auth()
            ->setTTL(60)
            ->claims([
                'jti' => Uuid::uuid(),
                'token_type' => 'access_token'
            ])
            ->login($user);

        return response([
            'access_token' => $newAccessToken,
            'refresh_token' => $newRefreshToken
        ],200);
    }




    public function store(Request $request)
    {
       dd($request);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
