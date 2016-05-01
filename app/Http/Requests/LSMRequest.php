<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LSMRequest extends Request
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
            'name'=>'min:3|max:50|required',
            'adzone'=>'required',
            'adhead'=>'required',
            'adcode'=>'min:10|required'
        ];
    }
}
