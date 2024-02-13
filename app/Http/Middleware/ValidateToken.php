<?php

namespace App\Http\Middleware;

use App\Services\TokenService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateToken
{
    public function __construct(private readonly TokenService $tokenService)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->bearerToken();

        $validationResult = $this->tokenService->validateAccessToken($access_token);

        if ($validationResult !== true){
            return response($validationResult,401);
        }

        return $next($request);
    }
}
