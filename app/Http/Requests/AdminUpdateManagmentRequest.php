<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateManagmentRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:300',
                Rule::unique('admins', 'name')->ignore(request()->admin_id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('admins', 'email')->ignore(request()->admin_id),
            ],
            'password' => 'nullable|string|min:8|max:15|confirmed',
            'type' => 'required|string|in:super-admin,content-management',
        ];
        
    }
}
