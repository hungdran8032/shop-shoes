<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'productId' => 'required|exists:products,id',
            'colorId' => 'required|exists:colors,id',
            'sizeId' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:0',
        ];
    }
}