<?php

namespace App\Providers;

use App\Contracts\JwtAuthServiceInterface;
use App\Contracts\Payment;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use App\Services\JwtAuthService;
use App\Services\PaymentService;
use http\Env;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(JwtAuthServiceInterface::class, JwtAuthService::class);

        $this->app->bind(Payment::class, function () {
            return new PaymentService(
                config('payment.merchant_id'),
                config('payment.secret'),
                config('payment.currency'),
                config('payment.domain')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
