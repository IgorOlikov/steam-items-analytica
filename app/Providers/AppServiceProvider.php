<?php

namespace App\Providers;

use App\Contracts\JwtAuthServiceInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use App\Services\JwtAuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //dd($this->app->request->route('category'));
        //dd($this->app->request->query->all());

        $this->app->bind(JwtAuthServiceInterface::class, JwtAuthService::class);
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
