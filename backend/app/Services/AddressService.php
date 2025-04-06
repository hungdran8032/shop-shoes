<?php

namespace App\Services;

use App\Models\Address;
use App\Repositories\AddressRepository;

class AddressService
{
    protected $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Lấy danh sách tất cả các địa chỉ.
     */
    public function getAllAddresses()
    {
        return $this->addressRepository->getAll();
    }

    /**
     * Tìm một địa chỉ theo ID.
     */
    public function getAddressById($id)
    {
        return $this->addressRepository->findById($id);
    }

    /**
     * Tạo một địa chỉ mới.
     */
    public function createAddress(array $data)
    {
        return $this->addressRepository->create($data);
    }

    /**
     * Cập nhật thông tin địa chỉ.
     */
    public function updateAddress($id, array $data)
    {
        $address = $this->addressRepository->findById($id);

        if (!$address) {
            return null; // Hoặc throw exception nếu cần
        }

        return $this->addressRepository->update($address, $data);
    }

    /**
     * Xóa một địa chỉ.
     */
    public function deleteAddress($id)
    {
        $address = $this->addressRepository->findById($id);

        if (!$address) {
            return false; // Hoặc throw exception nếu cần
        }

        return $this->addressRepository->delete($address);
    }
}