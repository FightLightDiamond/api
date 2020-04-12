<?php

namespace Tutorial\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonTestUpdateRequest extends FormRequest
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
            'lesson_id' => 'required',
            'question' => 'required',
            'reply1' => 'required',
            'reply2' => 'required',
            'reply3' => 'required',
            'reply4' => 'required',
            'answer' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
