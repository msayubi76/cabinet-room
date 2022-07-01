<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
        $id = $request->route('user');
        return [
            'name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'email:rfc,dns',Rule::unique('users')->ignore($id)],
            'password' => ['required', 'confirmed'],
            'profile' => ['nullable', 'mimes:jpg,bmp,png'],
        ];
    }
}
