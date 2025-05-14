<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAreaRequest extends FormRequest
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
            'name.en' => 'required|unique:shipping_areas,name->en',
            'name.ar' => 'required|unique:shipping_areas,name->ar',
            'fee' => 'required|numeric|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'name.en' => __('area.name_area_en'),
            'name.ar' => __('area.name_area_ar'),
            'fee' => __('area.fee'),
        ];
    }
}
