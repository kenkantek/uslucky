<?php

namespace App\Http\Requests\Admin\Discount;

use App\Http\Requests\Request;

class DiscountCreateRequest extends Request
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
            'name'     => 'bail|required|unique:discounts',
            'code'     => 'bail|required|alpha_num|min:7|max:15|unique:discounts',
            'value'    => 'bail|required|numeric|between:1,99',
            'begin_at' => 'bail|required',
            'end_at'   => 'bail|required|after:begin_at',
        ];
    }
}
