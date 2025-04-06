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
            'name' => 'nullable',         // Không bắt buộc, không kiểm tra kiểu
            'price' => 'nullable',        // Không bắt buộc, không kiểm tra kiểu
            'hot' => 'nullable',          // Không bắt buộc, không kiểm tra kiểu
            'sale' => 'nullable',         // Không bắt buộc, không kiểm tra kiểu
            'description' => 'nullable',  // Không bắt buộc, không kiểm tra kiểu
            'brandId' => 'nullable',      // Không bắt buộc, không kiểm tra tồn tại
            'categoryId' => 'nullable',   // Không bắt buộc, không kiểm tra tồn tại
            'images' => 'nullable',       // Không bắt buộc, không kiểm tra định dạng/kích thước
            'stocks' => 'nullable',       // Không bắt buộc, không kiểm tra là mảng
        ];
    }
}