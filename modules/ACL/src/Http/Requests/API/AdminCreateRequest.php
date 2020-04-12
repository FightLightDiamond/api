<?php

namespace ACL\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
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
        return [
            'name' => 'required',
'email' => 'required',
'password' => 'required',
'remember_token' => 'required',
'is_active' => 'required',

        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
