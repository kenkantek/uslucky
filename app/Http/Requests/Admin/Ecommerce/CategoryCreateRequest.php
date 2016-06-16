<?php

namespace App\Http\Requests\Admin\Ecommerce;

use App\Http\Requests\Request;

class CategoryCreateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'             => 'bail|required|min:3|max:255|unique:ecommerce_categories',
            'position'         => 'bail|required|numeric|min:1',
            'relationship.key' => 'bail|required|between:0,2',
        ];
    }
}
