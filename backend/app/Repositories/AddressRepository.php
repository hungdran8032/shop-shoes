<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    /**
     * Lấy tất cả các địa chỉ.
     */
    public function getAll()
    {
        return Address::with('orders')->get();
    }

    /**
     * Tìm một địa chỉ theo ID.
     */
    public function findById($id)
    {
        return Address::with('orders')->find($id);
    }

    /**
     * Tạo một địa chỉ mới.
     */
    public function create(array $data)
    {
        return Address::create($data);
    }

    /**
     * Cập nhật thông tin địa chỉ.
     */
    public function update(Address $address, array $data)
    {
        $address->update($data);
        return $address;
    }

    /**
     * Xóa một địa chỉ.
     */
    public function delete(Address $address)
    {
        return $address->delete();
    }
}