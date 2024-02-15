<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//api/v1/
Route::get('/', function () {
    return "hello";
})->middleware('api','jwt.verified');

Route::prefix('/auth')->middleware('api')->group(function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/refresh-tokens',[AuthController::class,'refreshTokens']);

    Route::get('/email/verify',[EmailVerificationController::class,'sendEmailVerificationLink'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',[EmailVerificationController::class,'verifyEmailHashUrl'])->middleware(['signed'])->name('verification.verify');
});


Route::middleware(
    [
        'api',
        'jwt.verified',
        'access.token.only'
    ])
    ->group(function () {
        Route::get('profile',[ProfileController::class,'index']);
});
