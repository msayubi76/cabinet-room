<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','max:255'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'description' => ['required'],
            'actual_price' => ['required'],
            'discount' => ['required'],
            'shipping_charge' => ['required'],
            'colour' => ['required'],
            'feature_image' => ['required'],
            'images' => ['required'],
            'length' => ['required'],
            'width' => ['required'],
            'is_feature_product' => ['nullable'],
            'is_arrival_product' => ['nullable'],
            'currency' => ['nullable'],

        ];
    }
}
