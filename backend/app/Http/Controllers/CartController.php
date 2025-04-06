<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->cartService->getAll());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->cartService->getById($id));
    }

    public function store(CartRequest $request): JsonResponse
    {
        return response()->json($this->cartService->create($request->validated()));
    }

    public function update(CartRequest $request, $id): JsonResponse
    {
        return response()->json($this->cartService->update($id, $request->validated()));
    }

    public function destroy($id): JsonResponse
    {
        return response()->json(['message' => 'Deleted successfully', 'result' => $this->cartService->delete($id)]);
    }

    public function getByUserId($userId): JsonResponse
    {
        $cart = $this->cartService->getByUserId($userId);
        return response()->json([
            'message' => 'Success!',
            'data' => $cart
        ]);
    }
}
