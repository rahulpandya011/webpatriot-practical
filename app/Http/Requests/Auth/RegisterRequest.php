<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required|numeric',
            'hobbies' => 'required',
            'profile_pic' => 'required|mimes:jpg,bmp,png',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => "First Name is requird",
            'last_name.required' => "Last Name is requird",
            'email.required' => "Email is requird",
            'email.email' => "Email should email only",
            'password.required' => "Password is requird",
            'password.min' => "Password min length should be 6",
            'confrim_password.required' => "Confirm Password is required",
            'confrim_password.same' => "Confirm Password and password should be same",
            'profile_pic.required' => "Profile Pic required",
            'hobbies.required' => "Hobbies required",
        ];
    }
}
