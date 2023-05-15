<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|size:10',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
