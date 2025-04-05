<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có được phép thực hiện request này không.
     */
    public function authorize(): bool
    {
        return true; // Đổi thành logic kiểm tra quyền nếu cần
    }

    /**
     * Quy tắc xác thực cho request.
     */
    public function rules(): array
    {
        return [
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
        ];
    }

    /**
     * Thông báo lỗi xác thực.
     */
    public function messages(): array
    {
        return [
            'city.required' => 'Thành phố là bắt buộc.',
            'country.required' => 'Quốc gia là bắt buộc.',
            'state.required' => 'Bang/Tỉnh là bắt buộc.',
            'zipcode.required' => 'Mã bưu điện là bắt buộc.',
        ];
    }
}