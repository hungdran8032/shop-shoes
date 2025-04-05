<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
// Route::get('/products', [ProductController::class, 'list']);
// /api/v1/products
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProducts']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
    Route::put('/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
});

Route::prefix('v1/brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']);
    Route::get('/{id}', [BrandController::class, 'show']);
    Route::post('/', [BrandController::class, 'store']);
    Route::put('/{id}', [BrandController::class, 'update']);
    Route::delete('/{id}', [BrandController::class, 'destroy']);
});

Route::prefix('v1/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);        // GET    /api/categories
    Route::get('/{id}', [CategoryController::class, 'show']);     // GET    /api/categories/{id}
    Route::post('/', [CategoryController::class, 'store']);       // POST   /api/categories
    Route::put('/{id}', [CategoryController::class, 'update']);   // PUT    /api/categories/{id}
    Route::delete('/{id}', [CategoryController::class, 'destroy']); // DELETE /api/categories/{id}
});

Route::prefix('v1/orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);        // GET    /api/orders
    Route::get('/{id}', [OrderController::class, 'show']);     // GET    /api/orders/{id}
    Route::post('/', [OrderController::class, 'store']);       // POST   /api/orders
    Route::put('/{id}', [OrderController::class, 'update']);   // PUT    /api/orders/{id}
    Route::delete('/{id}', [OrderController::class, 'destroy']); // DELETE /api/orders/{id}
});

Route::prefix('v1/addresses')->group(function () {
    Route::get('/', [AddressController::class, 'index']);        // GET    /api/addresses
    Route::get('/{id}', [AddressController::class, 'show']);     // GET    /api/addresses/{id}
    Route::post('/', [AddressController::class, 'store']);       // POST   /api/addresses
    Route::put('/{id}', [AddressController::class, 'update']);   // PUT    /api/addresses/{id}
    Route::delete('/{id}', [AddressController::class, 'destroy']); // DELETE /api/addresses/{id}
});
