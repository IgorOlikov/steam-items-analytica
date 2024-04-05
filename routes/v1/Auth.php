<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ResetPasswordController;


Route::prefix('/auth')->group(function () {

    Route::post('/register',[AuthController::class,'register'])->name('register');

    Route::post('/login',[AuthController::class,'login'])->name('login');

    Route::post('/refresh-tokens',[AuthController::class,'refreshTokens'])->name('refresh-tokens');

    Route::post('/logout',[AuthController::class,'logout'])->name('logout')
        ->middleware('access.token.only');


    Route::post('/email/verify',[EmailVerificationController::class,'sendEmailVerificationLink'])
        ->name('verification.notice')
        ->middleware([
            'access.token.only',
        ]);

    Route::get('/email/verify/{id}/{hash}',[EmailVerificationController::class,'verifyEmailHashUrl'])
        ->name('verification.verify')->middleware('access.token.only');


    Route::post('/forgot-password',[ResetPasswordController::class,'sendEmailPasswdResetLink'])
        ->middleware('guest')
        ->name('password.email');

    Route::post('/reset-password',[ResetPasswordController::class,'resetPassword'])
        ->middleware('guest')
        ->name('password.update');

});


