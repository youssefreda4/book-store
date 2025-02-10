<?php

namespace App\Http\Requests;

use App\Models\Discount;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'size:12',
                Rule::unique(Discount::class)->ignore(request()->discount_id)
            ],
            'quantity' => 'required|numeric|min:1|max:100',
            'precentage' => 'required|numeric|min:1|max:90',
            'expiry_date' => 'required|after:now',
        ];
    }

    public function attributes()
    {
        return [
            'code' => __('discount.code'),
            'quantity' => __('discount.quantity'),
            'precentage' => __('discount.precentage'),
            'expiry_date' => __('discount.expiry_date'),
        ];
    }
}
