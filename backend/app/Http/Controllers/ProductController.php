<?php
namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts(): JsonResponse
    {
        try {
            $products = $this->productService->getAllProducts();
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

  
    public function createProduct(Request $request): JsonResponse
    {
        try {
            $product = $this->productService->createProduct($request);
            return response()->json($product, 201);
        }  catch (\Exception $e) {
            \Log::info('Lỗi tạo sản phẩm: ' . $e->getMessage());

            return response()->json([
                'message' => 'Lỗi khi tạo sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }

   
}