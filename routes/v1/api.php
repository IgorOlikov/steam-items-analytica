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

    Route::get('/email/verify',[EmailVerificationController::class,'sendEmailVerificationLink'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',[EmailVerificationController::class,'verifyEmailHashUrl'])
        ->middleware(['signed'])->name('verification.verify');
});


Route::post('/forgot-password',[ResetPasswordController::class,'sendEmailPasswdResetLink'])->name('password.email');;
    //->middleware('guest');
Route::get('//reset-password/{token}',function (string $token) {
    return ['token' => $token]; })
    //->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password',[ResetPasswordController::class,'resetPassword'])
    //->middleware('guest')
    ->name('password.update');

Route::middleware(
    [
        'api',
        'jwt.verified',
        'access.token.only'
    ])
    ->group(function () {
        Route::get('profile',[ProfileController::class,'index']);
});
