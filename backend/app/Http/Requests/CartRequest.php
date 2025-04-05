<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'isPayed' => 'boolean',
            'productId' => 'required|exists:products,id',
            'brandId' => 'required|exists:brands,id',
            'userId' => 'required|exists:users,id',
            'orderId' => 'nullable|exists:orders,id',
        ];
    }
}
