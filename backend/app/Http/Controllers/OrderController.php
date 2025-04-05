<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Lấy danh sách tất cả các đơn hàng.
     */
    public function index(): JsonResponse
    {
        $orders = $this->orderService->getAllOrders();
        return response()->json($orders);
    }

    /**
     * Tạo một đơn hàng mới.
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated());
        return response()->json([
            'message' => 'Order created successfully!',
            'order' => $order,
        ], 201);
    }

    /**
     * Lấy thông tin chi tiết của một đơn hàng.
     */
    public function show($id): JsonResponse
    {
        $order = $this->orderService->getOrderById($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    /**
     * Cập nhật thông tin đơn hàng.
     */
    public function update(OrderRequest $request, $id): JsonResponse
    {
        $order = $this->orderService->updateOrder($id, $request->validated());

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json([
            'message' => 'Order updated successfully!',
            'order' => $order,
        ]);
    }

    /**
     * Xóa một đơn hàng.
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->orderService->deleteOrder($id);

        if (!$deleted) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(['message' => 'Order deleted successfully!']);
    }
}