<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ResetPasswordController;


Route::prefix('/auth')->middleware('api')->group(function (){
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::get('/refresh-tokens',[AuthController::class,'refreshTokens']);
    Route::post('/logout',[AuthController::class,'logout'])->name('logout')
        ->middleware('access.token.only');

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
