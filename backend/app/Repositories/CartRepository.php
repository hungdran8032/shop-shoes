<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function getAll()
    {
        return Cart::with(['product', 'brand', 'user', 'order'])->get();
    }

    public function findById($id)
    {
        return Cart::with(['product', 'brand', 'user', 'order'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Cart::create($data);
    }

    public function update($id, array $data)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($data);
        return $cart;
    }

    public function delete($id)
    {
        return Cart::destroy($id);
    }

    public function getByUserId($userId)
    {
        return Cart::with(['product', 'brand'])->where('userId', $userId)->get();
    }
}
