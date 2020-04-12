<?php

namespace ACL\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPassportRequest extends FormRequest
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
            'image' => 'required|image|mimes:png,jpeg,jpg,gif,svg|max:10240',
            'image2' => 'required|image|mimes:png,jpeg,jpg,gif,svg|max:10240',
            'passport_number' => 'required|string'
        ];
    }
}
