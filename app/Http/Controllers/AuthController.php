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

    public function index(Request $request)
    {
       // $request->user()
        return '/auth -> index() Resource api';
    }
    public function login(LoginRequest $request)
    {
        if(! auth()->attempt($request->validated())){
            return response(['message' => 'The provided credentials do not match our records']);
        }

        $user = $request->user();

        $accessToken = auth()
            ->setTTL(60)
            ->claims(['jti' => Uuid::uuid()])
            ->login($user);

        $refreshToken = auth()
            ->setTTL(43800)
            ->claims(['jti' => $refreshTokenId = Uuid::uuid()])
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
        ]);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function register(RegisterRequest $request)
    {

    }
    public function token(Request $request)
    {
      $a =  auth()->factory()->getTTL() * 60;
    }
    public function refreshTokens(RefreshTokensRequest $request)
    {

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
