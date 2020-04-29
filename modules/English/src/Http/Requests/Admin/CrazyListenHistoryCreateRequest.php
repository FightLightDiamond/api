<?php

namespace English\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CrazyListenHistoryCreateRequest extends FormRequest
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
            'user_id' => 'required',
'crazy_id' => 'required',
'count' => 'required',

        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
