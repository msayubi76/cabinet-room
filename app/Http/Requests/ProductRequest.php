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
            'sub_category_id' => ['required'],
            'description' => ['nullable'],
            'actual_price' => ['nullable'],
            'discount' => ['nullable'],
            'shipping_charge' => ['nullable'],
            'colour' => ['nullable'],
            'feature_image' => ['nullable'],
            'images' => ['nullable'],
            'length' => ['nullable'],
            'width' => ['nullable'],
            'is_feature_product' => ['nullable'],
            'is_arrival_product' => ['nullable'],
            'currency' => ['nullable'],

        ];
    }
}
