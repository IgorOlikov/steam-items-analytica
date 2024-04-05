<?php


use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryFilterController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


/* !Prefix api/v1! */

Route::get('/', function () {
    return "hello";
})->middleware('api','jwt.verified');


/* Auth routes */
require_once 'Auth.php';

Route::get('about', function () {
   return response('about',400);
});


/* Main site routes */
Route::apiResource('/catalog', CatalogController::class);
Route::get('/catalog/category/{category:slug}', [CatalogController::class,'showCatalogCategory']); //??!?!??


Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/attributes', AttributeController::class);
Route::apiResource('/attribute-values', AttributeValueController::class);


Route::apiResource('category.product', CategoryProductController::class)
    ->scoped([
        'category' => 'slug',
        'product' => 'slug'
    ]);


/* Filters */
Route::apiResource('category.filter', CategoryFilterController::class);
Route::apiResource('filter', FilterController::class);

/* Profile */
Route::middleware(
    [
        'auth:api',
        'access.token.only',
        'jwt.verified',

    ])
    ->group(function () {
        Route::get('profile',[ProfileController::class,'index']);
});



