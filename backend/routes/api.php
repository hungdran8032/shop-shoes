<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyAdminToken;


Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::get('/{id}', [ProductController::class, 'getById']);
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
    Route::post('/', [OrderController::class, 'createOrder']); 
});

Route::prefix('v1/addresses')->group(function () {
    Route::get('/', [AddressController::class, 'index']);        // GET    /api/addresses
    Route::get('/{id}', [AddressController::class, 'show']);     // GET    /api/addresses/{id}
    Route::post('/', [AddressController::class, 'store']);       // POST   /api/addresses
    Route::put('/{id}', [AddressController::class, 'update']);   // PUT    /api/addresses/{id}
    Route::delete('/{id}', [AddressController::class, 'destroy']); // DELETE /api/addresses/{id}
});

Route::prefix('v1/colors')->group(function () {
    Route::get('/', [ColorController::class, 'index']);
    Route::get('/{id}', [ColorController::class, 'show']);
    Route::post('/', [ColorController::class, 'store']);
    Route::put('/{id}', [ColorController::class, 'update']);
    Route::delete('/{id}', [ColorController::class, 'destroy']);
});
Route::prefix('v1/sizes')->group(function () {
    Route::get('/', [SizeController::class, 'index']);   
    Route::get('/{id}', [SizeController::class, 'show']);   
    Route::post('/', [SizeController::class, 'store']);      
    Route::put('/{id}', [SizeController::class, 'update']);   
    Route::delete('/{id}', [SizeController::class, 'destroy']); 
});

Route::prefix('v1/carts')->group(function () {
    Route::get('/', [CartController::class, 'getCartItems']);
    Route::get('/{id}', [CartController::class, 'getCartItemById']);       
    Route::post('/', [CartController::class, 'createCartItem']);       
    Route::get('/user/{id}', [CartController::class, 'getCartByUserId']);     
    Route::delete('/{id}', [CartController::class, 'deleteCartItem']); 
});


Route::prefix('v1/users')->group(function () {
    Route::get('{email}', [UserController::class, 'getUser']);
    Route::post('/', [UserController::class, 'createUser']);
    Route::put('{email}/role', [UserController::class, 'updateRole'])->middleware('verify.admin.token');
    Route::post('/admin', [UserController::class, 'loginAdmin']);
});

Route::prefix('v1/momo')->group(function () {
    Route::post('/create-payment', [PaymentController::class, 'createPayment']);
});


