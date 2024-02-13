<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokensRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\TokenService;
use Carbon\FactoryImmutable;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;
use Lcobucci\JWT\Validation\Validator;
use Psr\Clock\ClockInterface;

class AuthController extends Controller
{
    public function __construct(
        private readonly TokenService $tokenService
    )
    {
    }

    public function index()
    {
        return '/auth -> index() Resource api';
    }

    public function login(LoginRequest $request)
    {
        dd($request->validated());
    }

    public function register(RegisterRequest $request)
    {
        $creds = $request->validated();
        $user = User::create($creds);

        //$tokens = $this->tokenService->getTokens($user);

        return response($user,201);
    }

    public function token(Request $request)
    {

       $user = User::first();
       $tokens = $this->tokenService->getTokens($user, $request->ip(), $request->userAgent());
        return response($tokens);
    }

    public function validateToken(Request $request)
    {
       $token = $request->input('token');

        $parser = new Parser(new JoseEncoder());

        try {
            $token = $parser->parse($token);
        } catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
            echo 'Oh no, an error: ' . $e->getMessage();
        }

        $signer = new Sha256();

        $now = new FactoryImmutable();

        assert($token instanceof UnencryptedToken);

        $validator = new Validator();
        if (!$validator->validate($token, new SignedWith($signer, InMemory::plainText(env('SECRET_KEY'))))){
            return response(['message' => 'invalid token']);
        }
        if (!$validator->validate($token, new StrictValidAt($now))) {
            return response(['message' => 'token has expired']);
        }


        return response(['token' => $token->claims()->all()]);
    }

    public function refreshTokens(RefreshTokensRequest $request)
    {
            dd($request->validated());
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
