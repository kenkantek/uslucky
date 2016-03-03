<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getAccount()
    {
        \JavaScript::put([
            '_api' => [
                'user'        => route('front::settings.api.account'),
                'put_account' => route('front::account.put.account'),
                'put_avatar'  => route('front::account.avatar'),
            ],
        ]);
        return view('user.setings.account');
    }

    public function getApiAccount()
    {
        return $this->user;
    }

    public function getPayment()
    {
        \JavaScript::put([
            '_stripe'   => [
                'key' => config('services.stripe.key'),
            ],
            '_date'     => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
            ],
            '_payments' => $this->user->payments,
            '_api'      => [
                'post_payment'   => route('front::post.payment'),
                'put_payment'    => route('front::put.payment'),
                'delete_payment' => route('front::delete.payment'),
            ],
        ]);

        return view('user.setings.credit-card');
    }
}
