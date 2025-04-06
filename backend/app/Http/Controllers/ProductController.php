<?php
namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->productService->getAll();
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->productService->findById($id);
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Product not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $product = $this->productService->create($request);
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating product', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->productService->update($id, $request);
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating product', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->productService->delete($id);
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting product', 'error' => $e->getMessage()], 500);
        }
    }
}