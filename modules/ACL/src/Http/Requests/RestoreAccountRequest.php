<?php

namespace ACL\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestoreAccountRequest extends FormRequest
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
            'mnemonic' => 'required',
            // 'keystore' => 'required',
            // 'new_password' => 'required|string|min:8|max:72|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|password_white_space',
        ];
    }
}
