<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        return response()->json($this->brandService->getAllBrands(), 200);
    }

    public function show($id)
    {
        $brand = $this->brandService->getBrandById($id);
        if (!$brand) {
            return response()->json(['message' => 'Không tìm thấy thương hiệu'], 404);
        }
        return response()->json($brand, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $brand = $this->brandService->createBrand($request->only('name'));
        return response()->json($brand, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $brand = $this->brandService->updateBrand($id, $request->only('name'));
        if (!$brand) {
            return response()->json(['message' => 'Không tìm thấy thương hiệu'], 404);
        }
        return response()->json($brand, 200);
    }

    public function destroy($id)
    {
        $result = $this->brandService->deleteBrand($id);
        if (!$result) {
            return response()->json(['message' => 'Không tìm thấy thương hiệu'], 404);
        }
        return response()->json(['message' => 'Xóa thương hiệu thành công'], 200);
    }
}
