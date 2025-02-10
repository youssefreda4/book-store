<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'name.en' => 'required|unique:authors,name',
            'name.ar' => 'required|unique:authors,name',
        ];
    }

    public function attributes()
    {
        return [
            'name.en' => __('author.name_author_en'),
            'name.ar' => __('author.name_author_ar'),
        ];
    }
}
