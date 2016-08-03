<?php

namespace App\Http\Requests\Admin\Ecommerce;

use App\Http\Requests\Request;

class CreateProductRequest extends Request
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
			'name'        => 'bail|required|min:3|max:255',
			'description' => 'bail|required',
			'price'       => 'bail|required|numeric',
			'sale_price'  => 'bail|numeric',
			'thumb'       => 'bail|required|image',
		];
	}
}
