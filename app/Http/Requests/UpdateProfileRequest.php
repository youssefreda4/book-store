<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $id = auth('web')->id();
        return [
            'username' => 'required|string|min:3|max:255|unique:users,username,' . $id,
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|string|unique:users,email,' . $id,
            'phone' => 'nullable|phone:EG',
                Rule::unique('users', 'phone')->ignore($id),
            'addresses' => 'nullable|array',
            'addresses.*.address' => 'required|string|max:255',
           'addresses.*.delete' => 'nullable|string|in:1,2',
            'new_address' => 'nullable|string|max:255',
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return  [
            'addresses.*.address' => 'The address is required',
        ];
    }
}
