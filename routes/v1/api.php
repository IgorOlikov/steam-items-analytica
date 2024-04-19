<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Filter\CategoryFilterController;
use App\Http\Controllers\Filter\FilterController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\AttributeController;
use App\Http\Controllers\Product\AttributeValueController;
use App\Http\Controllers\Product\CategoryProductController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;


/* !Prefix api/v1! */

/* Auth routes */
require_once 'Auth.php';


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
Route::middleware([
        'auth:api',
        'access.token.only',
        'jwt.verified',
    ])->group(function () {
        Route::get('profile',[ProfileController::class,'index']);
});

/* Cart */
Route::middleware(['auth:api','jwt.verified','access.token.only'])->group(function () {
    Route::apiResource('cart', CartController::class);
    Route::post('cart-sync', [CartController::class, 'packetStore']);

    Route::apiResource('order', OrderController::class);
});

/* Admin */
Route::apiResource('admin', AdminController::class)
    ->middleware([
        'auth:api',
        'access.token.only',
        'jwt.verified',
        'admin',
    ]);


Route::get('about', function () {
    return response('about',400);
});

