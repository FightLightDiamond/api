<?php

namespace ACL\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'first_name' => 'required',
'last_name' => 'required',
'code' => 'required',
'email' => 'required',
'phone_number' => 'required',
'sex' => 'required',
'password' => 'required',
'birthday' => 'required',
'address' => 'required',
'avatar' => 'required',
'remember_token' => 'required',
'is_active' => 'required',
'last_login' => 'required',
'last_logout' => 'required',
'slack_webhook_url' => 'required',
'coin' => 'required',
'locale' => 'required',
'group_id' => 'required',

        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
