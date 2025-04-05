<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => $this->isMethod('post') ? 'required|min:6' : 'nullable|min:6',
            'role' => 'required|in:user,admin',
        ];
    }
}
