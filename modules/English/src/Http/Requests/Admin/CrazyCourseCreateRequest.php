<?php

namespace English\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CrazyCourseCreateRequest extends FormRequest
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
        logger(request()->all());
        return [
            'name' => 'required',
//            'img' => 'required',
            'description' => 'required',
            'is_active' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
