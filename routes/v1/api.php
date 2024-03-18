<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryFilterController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\JsonzController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


//api/v1/
Route::get('/', function () {
    return "hello";
})->middleware('api','jwt.verified');

Route::prefix('/auth')->middleware('api')->group(function (){
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::post('/refresh-tokens',[AuthController::class,'refreshTokens']);
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/email/verify',[EmailVerificationController::class,'sendEmailVerificationLink'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',[EmailVerificationController::class,'verifyEmailHashUrl'])
        ->middleware(['signed'])->name('verification.verify');

    Route::post('/forgot-password',[ResetPasswordController::class,'sendEmailPasswdResetLink'])
        ->middleware('guest')
        ->name('password.email');;
    Route::post('/reset-password',[ResetPasswordController::class,'resetPassword'])
        ->middleware('guest')
        ->name('password.update');
});

Route::apiResource('/catalog', CatalogController::class);
Route::get('/catalog/category/{category}', [CatalogController::class,'showCatalogCategory']);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/attributes', AttributeController::class);
Route::apiResource('/attribute-values', AttributeValueController::class);
Route::apiResource('/jsonz', JsonzController::class);

Route::apiResource('category.product', CategoryProductController::class);
Route::apiResource('category.filter', CategoryFilterController::class);
Route::apiResource('filter', FilterController::class);

Route::middleware(
    [
        'api',
        'access.token.only',
        'jwt.verified',

    ])
    ->group(function () {
        Route::get('profile',[ProfileController::class,'index']);
});

Route::get('test-guest',function (){
   $url = URL::temporarySignedRoute(
        'verification.verify',
        Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
        [
            'id' => 'aaaaa',
            'hash' => 'bbbbb',
        ]
    ,false);
   //return urlencode($url);
    return ($url);

    //return url(\route('login',null,false));
   //return 'GUEST!';
})->middleware('api','guest');
