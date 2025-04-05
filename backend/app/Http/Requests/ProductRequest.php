<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'name' => 'required|string',
            'link' => 'required|string',
            'price' => 'required|numeric',
            'hot' => 'boolean',
            'sale' => 'boolean',
            'description' => 'nullable|string',
        ];  
    }
}
