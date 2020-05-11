<?php

namespace Tutorial\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TutorialCreateRequest extends FormRequest
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
'img' => 'required',
'is_active' => 'required',
'description' => 'required',

        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
