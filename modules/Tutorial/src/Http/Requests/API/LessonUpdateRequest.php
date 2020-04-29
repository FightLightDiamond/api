<?php

namespace Tutorial\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
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
            'title' => '',
            'intro' => '',
            'content' => '',
            'section_id' => '',
            'is_active' => '',
            'no' => '',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
