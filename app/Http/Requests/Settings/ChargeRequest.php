<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Request;

class ChargeRequest extends Request
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
            'source'      => 'required',
            'amount'      => 'required|numeric|max:999999',
            'number'      => 'required',
            'month'       => 'required',
            'year'        => 'required',
            'cvc'         => 'required|digits:3',
            'description' => 'required|max:255|min:50',
        ];
    }

    public function messages()
    {
        return [
            'amount.max' => 'Amount must be no more than $999,999.99',
        ];
    }
}
