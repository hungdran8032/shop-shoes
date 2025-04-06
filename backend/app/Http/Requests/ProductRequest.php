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
<<<<<<< HEAD
            'name' => 'nullable',         // Không bắt buộc, không kiểm tra kiểu
            'price' => 'nullable',        // Không bắt buộc, không kiểm tra kiểu
            'hot' => 'nullable',          // Không bắt buộc, không kiểm tra kiểu
            'sale' => 'nullable',         // Không bắt buộc, không kiểm tra kiểu
            'description' => 'nullable',  // Không bắt buộc, không kiểm tra kiểu
            'brandId' => 'nullable',      // Không bắt buộc, không kiểm tra tồn tại
            'categoryId' => 'nullable',   // Không bắt buộc, không kiểm tra tồn tại
            'images' => 'nullable',       // Không bắt buộc, không kiểm tra định dạng/kích thước
            'stocks' => 'nullable',       // Không bắt buộc, không kiểm tra là mảng
=======
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'hot' => 'boolean',
            'sale' => 'boolean',
            'description' => 'nullable|string',
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
>>>>>>> af3fe4d32949ee5b1b7d950a6a6998b791b88982
        ];
    }
}