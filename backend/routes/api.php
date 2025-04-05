<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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
    Route::delete('/{id}', [CategoryController::class, 'destroy']);// DELETE /api/categories/{id}
});

