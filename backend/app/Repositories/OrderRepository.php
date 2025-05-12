<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * Lấy tất cả các đơn hàng.
     */
    public function getAll()
    {
        return Order::with(['address', 'carts'])->get();
    }

    /**
     * Tìm một đơn hàng theo ID.
     */
    public function findById($id)
    {
        return Order::with(['address', 'carts'])->find($id);
    }

    /**
     * Tạo một đơn hàng mới.
     */
    public function create(array $data)
    {
        return Order::create($data);
    }

    /**
     * Cập nhật thông tin đơn hàng.
     */
    public function update(Order $order, array $data)
    {
        $order->update($data);
        return $order;
    }

    /**
     * Xóa một đơn hàng.
     */
    public function delete(Order $order)
    {
        return $order->delete();
    }
}