<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountRequest extends Request
{
    public $minimum_old;

    public function __construct()
    {
        $this->minimum_old = env('MINIMUM_OLD', 13);
    }

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
            'first_name' => 'required',
            'last_name'  => 'required',
            'birthday'   => ['required', "before:{$this->minimum_old} years ago"],
            'phone'      => 'required|numeric',
            'zipcode'    => 'numeric|required',
            'address'    => 'required',
            'city'       => 'required',
            'country'    => 'required',
            'email'      => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'birthday.before' => trans('auth.minimum_old', ['number' => $this->minimum_old]),
        ];
    }
}
