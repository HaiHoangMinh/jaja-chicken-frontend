<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'customer_name' => 'required|string|max:255|min:5',
                'email' => 'required|string|email|max:255|unique:customers',
                'customer_password' => 'required|string|min:8',
                'customer_phone' => 'required|min:10|numeric',
                'home' => 'required|string|max:255',
                
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'Email đã được đăng ký!',
            'customer_name.min' => 'Họ và tên không hợp lệ',
            'customer_password.min' => 'Mật khẩu quá ngắn',
            'customer_phone.min' => 'Số điện thoại không hợp lệ',
            'customer_phone.numeric' => 'Số điện thoại không hợp lệ',
        ];
    }
}