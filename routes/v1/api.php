<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//api/v1/
Route::get('/', function () {
    return "hello";
});

Route::prefix('/auth')->middleware('api')->group(function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/refresh-tokens',[AuthController::class,'refreshTokens']);
});

Route::middleware(['api','jwt.verified'])->group(function () {
    Route::get('profile',[ProfileController::class,'index']);
});
