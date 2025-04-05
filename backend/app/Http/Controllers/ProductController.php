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
            \Log::error('Lỗi lấy danh sách sản phẩm: ' . $e->getMessage());
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function createProduct(Request $request): JsonResponse
    {
        try {
            $product = $this->productService->createProduct($request);
            return response()->json($product, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Lỗi xác thực: ', $e->errors());
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Lỗi tạo sản phẩm: ' . $e->getMessage());
            return response()->json([
                'message' => 'Lỗi khi tạo sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }
}