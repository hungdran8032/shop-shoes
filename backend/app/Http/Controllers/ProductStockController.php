<?php
namespace App\Http\Controllers;

use App\Services\ProductStockService;
use App\Http\Requests\ProductStockRequest;
use Illuminate\Http\JsonResponse;

class ProductStockController extends Controller
{
    protected $productStockService;

    public function __construct(ProductStockService $productStockService)
    {
        $this->productStockService = $productStockService;
    }

    public function index(): JsonResponse
    {
        try {
            $stocks = $this->productStockService->getAll();
            return response()->json($stocks, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $stock = $this->productStockService->findById($id);
            return response()->json($stock, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Stock not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function store(ProductStockRequest $request): JsonResponse
    {
        try {
            $stock = $this->productStockService->create($request);
            return response()->json($stock, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating stock', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(ProductStockRequest $request, $id): JsonResponse
    {
        try {
            $stock = $this->productStockService->update($id, $request);
            return response()->json($stock, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating stock', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->productStockService->delete($id);
            return response()->json(['message' => 'Stock deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting stock', 'error' => $e->getMessage()], 500);
        }
    }
}