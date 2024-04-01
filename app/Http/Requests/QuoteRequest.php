<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
            // 'user_id' => ['nullable'],
            'product_id' => ['required'],

            'name' => ['required'],
            'user_email' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],

            'discription' => ['required', 'max:3000'],

        ];
    }
}
