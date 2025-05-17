<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingAreaRequest extends FormRequest
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
            'name.en' => 'required|unique:shipping_areas,name->en,'.$this->route('area')->id,
            'name.ar' => 'required|unique:shipping_areas,name->ar,'.$this->route('area')->id,
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
