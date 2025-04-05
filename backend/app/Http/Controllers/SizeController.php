<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use Exception;
use Illuminate\Http\JsonResponse;

class SizeController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $sizes = Size::all();
            return response()->json($sizes, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $size = Size::find($id);
            if (!$size) {
                return response()->json(['message' => 'Không tìm thấy kích thước'], 404, [], JSON_UNESCAPED_UNICODE);
            }
            return response()->json($size, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreSizeRequest $request): JsonResponse
    {
        try {
            $size = Size::create($request->validated());
            return response()->json($size, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateSizeRequest $request, $id): JsonResponse
    {
        try {
            $size = Size::find($id);
            if (!$size) {
                return response()->json(['message' => 'Không tìm thấy kích thước'], 404, [], JSON_UNESCAPED_UNICODE);
            }
            $size->update($request->validated());
            return response()->json($size, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $size = Size::find($id);
            if (!$size) {
                return response()->json(['message' => 'Không tìm thấy kích thước'], 404, [], JSON_UNESCAPED_UNICODE);
            }
            $size->delete();
            return response()->json(['message' => 'Xóa kích thước thành công'], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }
}