<?php

// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\TestController;
// use App\Http\Controllers\BrandController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\AddressController;
// use App\Http\Controllers\ColorController;
// use App\Http\Controllers\SizeController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\UserController;
// use App\Http\Middleware\VerifyAdminToken;

// // Route::get('/products', [ProductController::class, 'list']);
// // /api/v1/products
// Route::prefix('v1/products')->group(function () {
//     Route::get('/', [ProductController::class, 'getAllProducts']);
//     Route::post('/', [ProductController::class, 'createProduct']);
//     Route::get('/{id}', [ProductController::class, 'getProductById']);
//     Route::put('/{id}', [ProductController::class, 'updateProduct']);
//     Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
// });

// Route::prefix('v1/brands')->group(function () {
//     Route::get('/', [BrandController::class, 'index']);
//     Route::get('/{id}', [BrandController::class, 'show']);
//     Route::post('/', [BrandController::class, 'store']);
//     Route::put('/{id}', [BrandController::class, 'update']);
//     Route::delete('/{id}', [BrandController::class, 'destroy']);
// });

// Route::prefix('v1/categories')->group(function () {
//     Route::get('/', [CategoryController::class, 'index']);        // GET    /api/categories
//     Route::get('/{id}', [CategoryController::class, 'show']);     // GET    /api/categories/{id}
//     Route::post('/', [CategoryController::class, 'store']);       // POST   /api/categories
//     Route::put('/{id}', [CategoryController::class, 'update']);   // PUT    /api/categories/{id}
//     Route::delete('/{id}', [CategoryController::class, 'destroy']); // DELETE /api/categories/{id}
// });

// Route::prefix('v1/orders')->group(function () {
//     Route::get('/', [OrderController::class, 'index']);        // GET    /api/orders
//     Route::get('/{id}', [OrderController::class, 'show']);     // GET    /api/orders/{id}
//     Route::post('/', [OrderController::class, 'store']);       // POST   /api/orders
//     Route::put('/{id}', [OrderController::class, 'update']);   // PUT    /api/orders/{id}
//     Route::delete('/{id}', [OrderController::class, 'destroy']); // DELETE /api/orders/{id}
// });

// Route::prefix('v1/addresses')->group(function () {
//     Route::get('/', [AddressController::class, 'index']);        // GET    /api/addresses
//     Route::get('/{id}', [AddressController::class, 'show']);     // GET    /api/addresses/{id}
//     Route::post('/', [AddressController::class, 'store']);       // POST   /api/addresses
//     Route::put('/{id}', [AddressController::class, 'update']);   // PUT    /api/addresses/{id}
//     Route::delete('/{id}', [AddressController::class, 'destroy']); // DELETE /api/addresses/{id}
// });
// // routes/api.php
// Route::prefix('v1/colors')->group(function () {
//     Route::get('/', [ColorController::class, 'index']);
//     Route::get('/{id}', [ColorController::class, 'show']);
//     Route::post('/', [ColorController::class, 'store']);
//     Route::put('/{id}', [ColorController::class, 'update']);
//     Route::delete('/{id}', [ColorController::class, 'destroy']);
// });
// Route::prefix('v1/sizes')->group(function () {
//     Route::get('/', [SizeController::class, 'index']);   
//     Route::get('/{id}', [SizeController::class, 'show']);   
//     Route::post('/', [SizeController::class, 'store']);      
//     Route::put('/{id}', [SizeController::class, 'update']);   
//     Route::delete('/{id}', [SizeController::class, 'destroy']); 
// });

// // Route::apiResource('v1/carts', CartController::class); // auto

// Route::prefix('v1/carts')->group(function () { // styles hehehe
//     Route::get('/', [CartController::class, 'index']);          // GET    /api/v1/carts
//     Route::get('/{id}', [CartController::class, 'show']);       // GET    /api/v1/carts/{id}
//     Route::post('/', [CartController::class, 'store']);         // POST   /api/v1/carts
//     Route::put('/{id}', [CartController::class, 'update']);     // PUT    /api/v1/carts/{id}
//     Route::delete('/{id}', [CartController::class, 'destroy']); // DELETE /api/v1/carts/{id}
// });


// Route::prefix('v1/users')->group(function () {
//     Route::get('{email}', [UserController::class, 'get']);
//     Route::post('/', [UserController::class, 'create']);
//     Route::put('/', [UserController::class, 'update']);
//     Route::put('{email}/role', [UserController::class, 'updateRole'])->middleware('verify.admin.token');
//     Route::post('/admin', [UserController::class, 'loginAdmin']);
// });
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// /api/v1/products
Route::prefix('v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProducts']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::get('/{id}', [ProductController::class, 'getById']);
});

Route::prefix('product-stocks')->group(function () {
    Route::get('/', [ProductStockController::class, 'index']);
    Route::get('/{id}', [ProductStockController::class, 'show']);
});

Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'index']);
    Route::get('/{id}', [ImageController::class, 'show']);
});

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']);
    Route::get('/{id}', [BrandController::class, 'show']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

Route::prefix('colors')->group(function () {
    Route::get('/', [ColorController::class, 'index']);
    Route::get('/{id}', [ColorController::class, 'show']);
});

Route::prefix('sizes')->group(function () {
    Route::get('/', [SizeController::class, 'index']);
    Route::get('/{id}', [SizeController::class, 'show']);
});

Route::prefix('users')->group(function () {
    Route::get('{email}', [UserController::class, 'get']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/', [UserController::class, 'update']);
    Route::post('/admin', [UserController::class, 'loginAdmin']);
});
Route::prefix('carts')->group(function () {
    //Route::get('/', [CartController::class, 'index']);
    //Route::middleware(['verify.admin'])->get('/', [CartController::class, 'index']);
    Route::get('/', [CartController::class, 'index'])->middleware('verify.admin.token');
    Route::get('/{id}', [CartController::class, 'show']);
    Route::get('/user/{userId}', [CartController::class, 'getByUserId']);
    Route::post('/', [CartController::class, 'store']);
    Route::put('/{id}', [CartController::class, 'update']);
    Route::delete('/{id}', [CartController::class, 'destroy']);
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});

Route::prefix('addresses')->group(function () {
    Route::get('/', [AddressController::class, 'index']);
    Route::get('/{id}', [AddressController::class, 'show']);
    Route::post('/', [AddressController::class, 'store']);
    Route::put('/{id}', [AddressController::class, 'update']);
    Route::delete('/{id}', [AddressController::class, 'destroy']);
});

// Protected routes (Admin only)
Route::middleware('verify.admin.token')->group(function () {
    Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('product-stocks')->group(function () {
        Route::post('/', [ProductStockController::class, 'store']);
        Route::put('/{id}', [ProductStockController::class, 'update']);
        Route::delete('/{id}', [ProductStockController::class, 'destroy']);
    });

    Route::prefix('images')->group(function () {
        Route::post('/', [ImageController::class, 'store']);
        Route::put('/{id}', [ImageController::class, 'update']);
        Route::delete('/{id}', [ImageController::class, 'destroy']);
    });

    Route::prefix('brands')->group(function () {
        Route::post('/', [BrandController::class, 'store']);
        Route::put('/{id}', [BrandController::class, 'update']);
        Route::delete('/{id}', [BrandController::class, 'destroy']);
    });

    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    // Route::prefix('orders')->group(function () {
    //     Route::get('/', [OrderController::class, 'index']);
    //     Route::get('/{id}', [OrderController::class, 'show']);
    //     Route::post('/', [OrderController::class, 'store']);
    //     Route::put('/{id}', [OrderController::class, 'update']);
    //     Route::delete('/{id}', [OrderController::class, 'destroy']);
    // });

    // Route::prefix('addresses')->group(function () {
    //     Route::get('/', [AddressController::class, 'index']);
    //     Route::get('/{id}', [AddressController::class, 'show']);
    //     Route::post('/', [AddressController::class, 'store']);
    //     Route::put('/{id}', [AddressController::class, 'update']);
    //     Route::delete('/{id}', [AddressController::class, 'destroy']);
    // });

    Route::prefix('colors')->group(function () {
        Route::post('/', [ColorController::class, 'store']);
        Route::put('/{id}', [ColorController::class, 'update']);
        Route::delete('/{id}', [ColorController::class, 'destroy']);
    });

    Route::prefix('sizes')->group(function () {
        Route::post('/', [SizeController::class, 'store']);
        Route::put('/{id}', [SizeController::class, 'update']);
        Route::delete('/{id}', [SizeController::class, 'destroy']);
    });

    // Route::prefix('carts')->group(function () {
    //     Route::get('/', [CartController::class, 'index']);
    //     Route::get('/{id}', [CartController::class, 'show']);
    //     Route::post('/', [CartController::class, 'store']);
    //     Route::put('/{id}', [CartController::class, 'update']);
    //     Route::delete('/{id}', [CartController::class, 'destroy']);
    // });

    Route::prefix('users')->group(function () {
        Route::put('{email}/role', [UserController::class, 'updateRole']);
    });
});
