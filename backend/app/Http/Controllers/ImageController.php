<?php
namespace App\Http\Controllers;

use App\Services\ImageService;
use App\Http\Requests\ImageRequest;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): JsonResponse
    {
        try {
            $images = $this->imageService->getAll();
            return response()->json($images, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $image = $this->imageService->findById($id);
            return response()->json($image, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Image not found', 'error' => $e->getMessage()], 404);
        }
    }

    public function store(ImageRequest $request): JsonResponse
    {
        try {
            $image = $this->imageService->create($request);
            return response()->json($image, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating image', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(ImageRequest $request, $id): JsonResponse
    {
        try {
            $image = $this->imageService->update($id, $request);
            return response()->json($image, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating image', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->imageService->delete($id);
            return response()->json(['message' => 'Image deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting image', 'error' => $e->getMessage()], 500);
        }
    }
}