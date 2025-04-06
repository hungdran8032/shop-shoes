<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'totalPrice' => 'required|numeric|min:0',
            'addressId' => 'required|exists:addresses,id',
        ];
    }
    

    /**
     * Thông báo lỗi xác thực.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'totalPrice.required' => 'Giá tổng là bắt buộc.',
            'addressId.required' => 'Địa chỉ là bắt buộc.',
        ];
    }
}