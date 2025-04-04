<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
// Route::get('/products', [ProductController::class, 'list']);
// /api/v1/products
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('v1/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);        // GET    /api/categories
    Route::get('/{id}', [CategoryController::class, 'show']);     // GET    /api/categories/{id}
    Route::post('/', [CategoryController::class, 'store']);       // POST   /api/categories
    Route::put('/{id}', [CategoryController::class, 'update']);   // PUT    /api/categories/{id}
    Route::delete('/{id}', [CategoryController::class, 'destroy']);// DELETE /api/categories/{id}
});