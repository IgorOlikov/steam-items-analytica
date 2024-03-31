<?php

namespace App\Facades;

use App\Contracts\JwtAuthServiceInterface;
use Illuminate\Support\Facades\Facade;


/**
 * @return JwtAuthServiceInterface
 */
class JwtAuthService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return JwtAuthServiceInterface::class;
    }

}
