<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   ShippingRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'email' => ['required'],
            'notes' => ['nullable', 'max:400'],
            'payment_method' => ['required', 'in:cod,online_transfer'],
            'payment_receipt' => 'required_if:payment_method,online_transfer|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'shipping_charges' => 'required|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',

        ];
    }
}
