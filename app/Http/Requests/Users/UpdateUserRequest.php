<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'phone' => 'required|size:10',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
