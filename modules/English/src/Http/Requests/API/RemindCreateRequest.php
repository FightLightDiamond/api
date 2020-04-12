<?php

namespace English\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class RemindCreateRequest extends FormRequest
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
            'hour' => 'required|min:0|max:23',
            'minute' => 'required|min:0:max:59',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
