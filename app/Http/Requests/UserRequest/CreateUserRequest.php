<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=>'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'phone'=>'required|regex:/[0-9]+/|between:1,31',
            'address'=>'required|max:500',
            'email'=>'nullable|email|max:255|unique:users',
            'username'=>'required|string|max:255|min:4|alpha_dash|unique:users',
            'password'=>'required|min:6|confirmed',
            'image'=>'|image|mimes:jpeg,png,jpg|max:3072',
        ];
        return $rules;
    }
}
