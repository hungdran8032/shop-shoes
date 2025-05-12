<?php
// app/Http/Controllers/ColorController.php
namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Services\ColorService;
use Illuminate\Http\JsonResponse;

class ColorController extends Controller
{
    protected $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    public function index(): JsonResponse
    {
        try {
            $colors = $this->colorService->getAllColors();
            return response()->json($colors, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $color = $this->colorService->getColorById($id);
            if (!$color) {
                return response()->json(['message' => 'Không tìm thấy màu'], 404);
            }
            return response()->json($color, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(ColorRequest $request): JsonResponse
    {
        try {
            $color = $this->colorService->createColor($request->validated());
            return response()->json($color, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(ColorRequest $request, $id): JsonResponse
    {
        try {
            $color = $this->colorService->getColorById($id);
            if (!$color) {
                return response()->json(['message' => 'Không tìm thấy màu'], 404);
            }
            $updatedColor = $this->colorService->updateColor($id, $request->validated());
            return response()->json($updatedColor, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $color = $this->colorService->getColorById($id);
            if (!$color) {
                return response()->json(['message' => 'Không tìm thấy màu'], 404);
            }
            $this->colorService->deleteColor($id);
            return response()->json(['message' => 'Xóa màu thành công'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi server', 'error' => $e->getMessage()], 500);
        }
    }
}
