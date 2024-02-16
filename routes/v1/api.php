<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;


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
    Route::get('/reset-password/{token}',function (string $token) {
        return ['token' => $token]; })
        ->middleware('guest')
        ->name('password.reset');
    Route::post('/reset-password',[ResetPasswordController::class,'resetPassword'])
        ->middleware('guest')
        ->name('password.update');
});




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
   return 'GUEST!';
})->middleware('api','guest');
