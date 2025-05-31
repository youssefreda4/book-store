<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:60',
            'email' => 'required|string|email',
            'message' => 'required|string|min:5|max:2000',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __("website/contact.name"),
            'email' => __("website/contact.email"),
            'message' => __("website/contact.message"),
        ];
    }
}
