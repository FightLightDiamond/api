<?php

namespace ETest\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreateRequest extends FormRequest
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
            'type' => 'required',
'question' => 'required',
'answer' => 'required',
'status' => 'required',
'time' => 'required',
'level' => 'required',


        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
