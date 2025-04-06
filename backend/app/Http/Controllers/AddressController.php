<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Services\AddressService;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Lấy danh sách tất cả các địa chỉ.
     */
    public function index(): JsonResponse
    {
        $addresses = $this->addressService->getAllAddresses();
        return response()->json($addresses);
    }

    /**
     * Tạo một địa chỉ mới.
     */
    public function store(AddressRequest $request): JsonResponse
    {
        $address = $this->addressService->createAddress($request->validated());
        return response()->json([
            'message' => 'Address created successfully!',
            'address' => $address,
        ], 201);
    }

    /**
     * Lấy thông tin chi tiết của một địa chỉ.
     */
    public function show($id): JsonResponse
    {
        $address = $this->addressService->getAddressById($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json($address);
    }

    /**
     * Cập nhật thông tin địa chỉ.
     */
    public function update(AddressRequest $request, $id): JsonResponse
    {
        $address = $this->addressService->updateAddress($id, $request->validated());

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json([
            'message' => 'Address updated successfully!',
            'address' => $address,
        ]);
    }

    /**
     * Xóa một địa chỉ.
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->addressService->deleteAddress($id);

        if (!$deleted) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json(['message' => 'Address deleted successfully!']);
    }
}