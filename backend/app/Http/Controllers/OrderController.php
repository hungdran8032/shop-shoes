<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            // $request->validate([
            //     'name' => 'required|string',
            //     'email' => 'required|email',
            //     'phone' => 'required|string',
            //     'address.city' => 'required|string',
            //     'address.country' => 'required|string',
            //     'address.state' => 'required|string',
            //     'address.zipcode' => 'required|string',
            //     'carts' => 'required|array',
            //     'carts.*' => 'exists:carts,id',
            //     'totalPrice' => 'required|numeric|min:0',
            // ]);

            $addressData = $request->address;
            $existingAddress = Address::where([
                'city' => $addressData['city'],
                'country' => $addressData['country'],
                'state' => $addressData['state'],
                'zipcode' => $addressData['zipcode'],
            ])->first();

            if (!$existingAddress) {
                $existingAddress = Address::create($addressData);
            }

            $newOrder = Order::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'totalPrice' => $request->totalPrice,
                'addressId' => $existingAddress->id,
            ]);

            Cart::whereIn('id', $request->carts)->update([
                'orderId' => $newOrder->id,
                'isPayed' => true,
            ]);

            return response()->json([
                'message' => 'Đơn hàng đã được tạo thành công!',
                'order' => $newOrder,
            ], 201);
        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo đơn hàng: " . $e->getMessage());
            return response()->json([
                'message' => 'Lỗi server',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}