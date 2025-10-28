<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

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
    public function rules(Request $request)
    {  
        return [
            'name' => ['required', 'max:255'],
            'category_id' => ['required'],
            'sub_category_id' => ['nullable'],
            'description' => ['required'],
            'actual_price' => ['required_without:is_for_request_quote', 'nullable', 'integer'],
            'discount' => ['nullable', 'integer', 'max:100', 'min:0'],
            'saleprice' => ['required_without:is_for_request_quote', 'nullable', 'integer'],
            'stock' => ['required_without:is_for_request_quote',  'nullable', 'integer'],
            'have_variations' => ['nullable', 'boolean'],
            'feature_image' => [
                'nullable', File::image()
                    ->max(12 * 1024),
            ],
            'images.*' => ['nullable', File::image()
                ->max(12 * 1024),],
            // for furniture only
            'colour' => ['nullable'],
            'length' => ['nullable'],
            'width' => ['nullable'],
            'height' => ['nullable'],
            'weight' => ['nullable'],
            'weight_unit' => ['nullable'],
            'dimension_unit' => ['nullable'],
            'tcs_product_description' => ['nullable'],
            'is_feature_product' => ['nullable', 'boolean'],
            'is_arrival_product' => ['nullable', 'boolean'],
            'currency' => ['required_without:is_for_request_quote',  'nullable'],
            'short_description' => ['required'],
            'is_active' => ['nullable', 'boolean'],
            'is_for_request_quote' => ['nullable', 'boolean'],
            'delivered_in' => ['nullable', 'string'],
            'rating' => ['nullable', 'min:1', 'max:5', 'numeric'],
            'is_installment_available' => ['nullable', 'boolean'],
            'shipping_charge' =>['nullable', 'numeric'],


        ];
    }
}
