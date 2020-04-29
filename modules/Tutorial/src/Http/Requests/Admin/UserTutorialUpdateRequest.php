<?php

namespace Tutorial\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserTutorialUpdateRequest extends FormRequest
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
            'user_id' => '',
            'tutorial_id' => '',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
