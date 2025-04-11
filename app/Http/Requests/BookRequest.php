<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'name.en' => 'required|string|min:5|max:500||unique:books,name',
            'name.ar' => 'required|string|min:5|max:500||unique:books,name',
            'description.en' => 'required|string|min:8|max:2000|unique:books,description',
            'description.ar' => 'required|string|min:8|max:2000|unique:books,description',
            'quantity' => 'required|numeric|gte:0',
            'rate' => 'required|numeric|min:0|max:5',
            'publish_year' => 'required|numeric|max:2025|digits:4',
            'price' => 'required|numeric|gte:0',
            'is_available' => 'nullable|numeric|min:0|max:1',
            'category_id' => 'required|numeric|exists:categories,id',
            'publisher_id' => 'required|numeric|exists:publishers,id',
            'author_id' => 'required|numeric|exists:authors,id',
            'discountable_type'=> 'string',
            'discountable_id' => 'required|numeric|exists:discounts,id',
            'image' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name.en' => __('book.name_book_en'),
            'name.ar' => __('book.name_book_ar'),
            'description.en' =>__('book.description_book_en') ,
            'description.ar' =>__('book.description_book_ar') ,
            'quantity' => __('book.quantity'),
            'rate' => __('book.rate'),
            'publish_year' => __('book.publish_year'),
            'price' => __('book.price'),
            'is_available' => __('book.is_available'),
            'category_id' => __('book.category'),
            'publisher_id' => __('book.publisher'),
            'author_id' => __('book.author'),
            'discountable_id'=>__('book.discount'),
            'image' => __('adminlte::adminlte.image'),
        ];
    }
}
