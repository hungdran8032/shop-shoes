<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Lấy danh sách tất cả các đơn hàng.
     */
    public function getAllOrders()
    {
        return $this->orderRepository->getAll();
    }

    /**
     * Tìm một đơn hàng theo ID.
     */
    public function getOrderById($id)
    {
        return $this->orderRepository->findById($id);
    }

    /**
     * Tạo một đơn hàng mới.
     */
    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }

    /**
     * Cập nhật thông tin đơn hàng.
     */
    public function updateOrder($id, array $data)
    {
        $order = $this->orderRepository->findById($id);

        if (!$order) {
            return null; // Hoặc throw exception nếu cần
        }

        return $this->orderRepository->update($order, $data);
    }

    /**
     * Xóa một đơn hàng.
     */
    public function deleteOrder($id)
    {
        $order = $this->orderRepository->findById($id);

        if (!$order) {
            return false; // Hoặc throw exception nếu cần
        }

        return $this->orderRepository->delete($order);
    }
}