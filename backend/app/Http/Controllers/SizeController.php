<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Services\SizeService;
use Illuminate\Http\JsonResponse;

class SizeController extends Controller
{
    protected $service;

    public function __construct(SizeService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $sizes = $this->service->getAllSizes();
        return response()->json($sizes, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show($id): JsonResponse
    {
        $size = $this->service->getSizeById($id);
        if (!$size) {
            return response()->json(['message' => 'Không tìm thấy kích thước'], 404, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->json($size, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreSizeRequest $request): JsonResponse
    {
        $size = $this->service->createSize($request->validated());
        return response()->json($size, 201, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateSizeRequest $request, $id): JsonResponse
    {
        $size = $this->service->updateSize($id, $request->validated());
        if (!$size) {
            return response()->json(['message' => 'Không tìm thấy kích thước'], 404, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->json($size, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->service->deleteSize($id);
        if (!$deleted) {
            return response()->json(['message' => 'Không tìm thấy kích thước'], 404, [], JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['message' => 'Xóa kích thước thành công'], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
