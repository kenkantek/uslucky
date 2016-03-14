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
            'amount'      => 'required|numeric|max:999999',
            'payment'     => 'required|exists:payments,id',
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
