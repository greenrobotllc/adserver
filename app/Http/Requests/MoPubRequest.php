<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MoPubRequest extends Request
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
            'ad_unit_id'=>'min:3|required'
        ];
    }
}
