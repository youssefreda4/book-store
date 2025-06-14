<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name.en' => 'required|unique:categories,name->en',
            'name.ar' => 'required|unique:categories,name->ar',
        ];
    }

    public function attributes()
    {
        return [
            'name.en' => __('category.name_category_en'),
            'name.ar' => __('category.name_category_ar'),
        ];
    }
}
