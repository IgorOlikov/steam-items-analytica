<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;
use Tymon\JWTAuth\Exceptions\InvalidClaimException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\PayloadException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (TokenExpiredException $e, Request $request) {
            return response()->json(['message' => 'Token has expired'], 401);
        });

        $this->renderable(function (TokenBlacklistedException $e, Request $request) {
            return response()->json(['message' => 'Token in blacklist'], 400);
        });

        $this->renderable(function (TokenInvalidException $e, Request $request) {
            return response()->json(['message' => 'Invalid token, could not decode token from JSON'], 400);
        });

        $this->renderable(function (InvalidClaimException $e, Request $request) {
            return response()->json(['message' => 'Invalid token, invalid token claim'], 400);
        });

        $this->renderable(function (PayloadException $e, Request $request) {
            return response()->json(['message' => 'Invalid token,  invalid token payload'], 400);
        });

        $this->renderable(function (JWTException $e, Request $request) {
            return response()->json(['message' => 'Token could not be parsed from the request'], 400);
        });


    }
}
