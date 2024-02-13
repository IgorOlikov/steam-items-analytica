<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





//api/v1/
Route::get('/', function () {
    return "hello";
});

Route::prefix('/auth')->group(function (){
   Route::get('/token',[AuthController::class,'token']);
    Route::post('/refresh-tokens',[AuthController::class,'refreshTokens']);
    Route::post('/token-validate',[AuthController::class,'validateToken']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
});

