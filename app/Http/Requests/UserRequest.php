<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $route_id = $request->route('user');


        if (empty($route_id) && $request->isMethod('put')) :
            $route_id = auth()->user()->id;
        endif;




        $rules =  [
            'name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'mobile_no' => ['nullable',  'max:11'],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'region' => ['nullable'],
            'email' => ['required', Rule::unique('users')->ignore($route_id)],
            'profile' => ['nullable', 'mimes:jpg,bmp,png'],
        ];

        if ((!empty($request->route('user') || !$request->isMethod('put'))) &&   !$request->isMethod('put')) :
        // $rules['password'] = ['required', 'confirmed'];
        endif;
        if (empty($request->route('user'))) :
            $rules['email'] = ['nullable'];
        endif;



        return $rules;
    }
}
