<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Ui\Presets\React;

class EditUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
      
        $id = $this->route('user');
        $id = decrypt($id);
        $rules = [
            'name'=>'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'phone'=>'required|regex:/[0-9]+/|between:1,31',
            'address'=>'required|max:500',
            'file'=>'|image|mimes:jpeg,png,jpg|max:3072',
            'email'=>'required|email|max:255|'. Rule::unique('users')->ignore($id),
            'username'=>'required|string|max:255|min:4|alpha_dash|'. Rule::unique('users')->ignore($id)
        ];
        return $rules;
    }
}
