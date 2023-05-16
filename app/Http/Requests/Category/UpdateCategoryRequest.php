<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name,'.$this->route('category'),
            'parent_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value != 0)
                    {
                        if (!Category::where('id', $value)->exists() || $this->route('category') == $value)
                        {
                            $fail('The selected parent id is invalid!');
                        }
                    }
                },
            ]
        ];
    }
}
