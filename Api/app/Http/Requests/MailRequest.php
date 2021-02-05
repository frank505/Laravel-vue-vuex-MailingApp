<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *"
     * @return array
     */

    public function rules()
    {
        return [
            "from"=>"required",
            "to"=>"required",
            "subject"=>"required",
            "html_content"=>"required",
            'text_content'=>'required',

        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages()
    {
        return [
            'from.required' => 'from field is required',
            'to.required' => 'to field is required',
            'subject.required'=>'subject field is required',
            'html_content.required'=>'html content field is required',
            'text_content.required'=>'text content field is required'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                "success"=>false,
                "error"=>$validator->errors(),
                "message"=>"one or more fields are required"
            ], 400));
    }

}
