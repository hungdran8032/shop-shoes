<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Route::get('/products', [ProductController::class, 'list']);
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});