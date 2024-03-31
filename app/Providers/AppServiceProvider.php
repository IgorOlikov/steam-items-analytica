<?php

namespace App\Providers;

use App\Contracts\JwtAuthServiceInterface;
use App\Services\JwtAuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JwtAuthServiceInterface::class, JwtAuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
