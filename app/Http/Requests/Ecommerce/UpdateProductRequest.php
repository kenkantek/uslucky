<?php

namespace App\Http\Requests\Ecommerce;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
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
            'name'        => 'bail|required|unique:products,name,' . $this->products->id,
            'description' => 'bail|required',
            'price'       => 'bail|required|numeric',
            'thumb'       => 'bail',
        ];
    }
}
