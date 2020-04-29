<?php

namespace English\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class /**/
CrazyUpdateRequest extends FormRequest
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
            'audio' => 'required',
            'is_active' => 'required',
            'crazy_course_id' => 'required',
            'img' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
