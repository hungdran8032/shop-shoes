<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'hot' => 'boolean',
            'sale' => 'boolean',
            'description' => 'nullable|string',
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
        ];
    }
}