<?php

namespace GCard\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HeroCreateRequest extends FormRequest
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
'nickname' => 'required',
'role' => 'required',
'sayings' => 'required',
'class_id' => 'required',
'image' => 'required',
'element_id' => 'required',
'publish_time' => 'required',
'status' => 'required',

        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
