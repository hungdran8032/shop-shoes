<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Add your authorization logic if needed
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên màu là bắt buộc',
            'name.string' => 'Tên màu phải là chuỗi ký tự',
            'name.max' => 'Tên màu không được vượt quá 255 ký tự',
        ];
    }
}
