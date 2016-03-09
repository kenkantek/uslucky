<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Request;

class ClaimRequest extends Request
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
            'amount'      => 'required|numeric|min:' . env('MINIMUM_AMOUNT'),
            'description' => 'required|max:255|min:50',
        ];
    }

    public function messages()
    {
        return [
            'amount.min' => 'Minimum one claim $25',
        ];
    }
}
