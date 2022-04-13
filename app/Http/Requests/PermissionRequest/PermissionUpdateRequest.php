<?php

namespace App\Http\Requests\PermissionRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class PermissionUpdateRequest extends FormRequest
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
        $id = $this->route('permission');
        $id = decrypt($id);
        return [
            'name' => 'required|max:150|' . Rule::unique('permissions')->ignore($id),
            'module_name' => 'required|max:150',
        ];
    }
}
