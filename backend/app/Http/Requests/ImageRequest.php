<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,webp|max:5120', // Max 5MB
            'productId' => 'required|exists:products,id',
        ];
    }
}