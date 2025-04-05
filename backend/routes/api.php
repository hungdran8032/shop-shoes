<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SizeController;
// Route::get('/products', [ProductController::class, 'list']);
// /api/v1/products
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
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
    Route::delete('/{id}', [CategoryController::class, 'destroy']);// DELETE /api/categories/{id}
});

Route::prefix('v1/sizes')->group(function () {
    Route::get('/', [SizeController::class, 'index']);        // GET    /api/v1/sizes
    Route::get('/{id}', [SizeController::class, 'show']);     // GET    /api/v1/sizes/{id}
    Route::post('/', [SizeController::class, 'store']);       // POST   /api/v1/sizes
    Route::put('/{id}', [SizeController::class, 'update']);   // PUT    /api/v1/sizes/{id}
    Route::delete('/{id}', [SizeController::class, 'destroy']);// DELETE /api/v1/sizes/{id}
});