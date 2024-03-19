<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ProductVariationRequest extends FormRequest
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
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric', 'min:0'],
            'value' => ['required', 'string'],
            'product_id' => ['required', 'exists:products,id'],
            'images.*' => ['required', File::image()
                ->max(12 * 1024),]
        ];
    }
}
