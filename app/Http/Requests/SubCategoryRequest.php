<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'category_id' => ['nullable','integer'],
            'name' => ['required'],
            'profile' => ['nullable', 'mimes:jpg,bmp,png'],
            'sort_order' => ['nullable'],
            'is_active' => ['nullable'],
        ];
    }
}
