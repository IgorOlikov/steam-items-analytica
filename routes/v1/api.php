<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::get('/', function () {
    return "hello";
});

Route::apiResource('/auth', AuthController::class);



Route::get('/auth/login', function () {
    return "hello";
});
