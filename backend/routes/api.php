<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
// Route::get('/products', [ProductController::class, 'list']);
// /api/v1/products
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
//api/v1/brands
Route::prefix('v1/brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']);
    Route::post('/', [BrandController::class, 'store']);
    Route::get('/{id}', [BrandController::class, 'show']);
    Route::put('/{id}', [BrandController::class, 'update']);
    Route::delete('/{id}', [BrandController::class, 'destroy']);
});