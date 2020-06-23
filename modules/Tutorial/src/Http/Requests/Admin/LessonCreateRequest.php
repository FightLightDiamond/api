<?php

namespace Tutorial\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LessonCreateRequest extends FormRequest
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
            'title' => 'required',
'intro' => 'required',
'content' => 'required',
'section_id' => 'required',
'views' => 'required',
'last_view' => 'required',

'is_active' => 'required',
'no' => 'required',

        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
