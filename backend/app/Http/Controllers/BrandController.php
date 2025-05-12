<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use Exception;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(): JsonResponse
    {
        try {
            $brands = $this->brandService->getAllBrands();
            return response()->json($brands, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $brand = $this->brandService->getBrandById($id);
            return response()->json($brand, 200);
        } catch (Exception $e) {
            $status = $e->getCode() === 404 ? 404 : 500;
            return response()->json(['message' => $e->getMessage()], $status);
        }
    }

    public function store(StoreBrandRequest $request): JsonResponse
    {
        try {
            $data = $request->validated(); // Get validated data
            $brand = $this->brandService->createBrand($data);
            return response()->json($brand, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateBrandRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->validated(); // Get validated data
            $brand = $this->brandService->updateBrand($id, $data);
            return response()->json($brand, 200);
        } catch (Exception $e) {
            $status = $e->getCode() === 404 ? 404 : 500;
            return response()->json(['message' => $e->getMessage()], $status);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->brandService->deleteBrand($id);
            return response()->json(['message' => 'Xóa thương hiệu thành công'], 200);
        } catch (Exception $e) {
            $status = $e->getCode() === 404 ? 404 : 500;
            return response()->json(['message' => $e->getMessage()], $status);
        }
    }
}