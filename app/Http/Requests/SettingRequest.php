<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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

            'about_us_detail' => ['required'],
            'contact_us_detail' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'mobile_no1' => ['required'],
            'mobile_no2' => ['required'],

            'address' => ['required'],
            'privacyAndPolicyDetail' => ['nullable'],

        ];
    }
}
