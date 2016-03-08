<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('active');
    }

    public function getAccount()
    {
        \JavaScript::put([
            '_api'        => [
                'user'        => route('front::settings.api.account'),
                'put_account' => route('front::account.put.account'),
                'put_avatar'  => route('front::account.avatar'),
            ],
            '_countries'  => file_get_contents(storage_path('countries.json')),
            '_changepass' => route('front::account.put.changepass'),
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

    public function getWinning()
    {
        \JavaScript::put([
            '_link'     => [
                'payment' => route('front::settings.payment'),
            ],
            '_api'      => [
                'charge' => route('front::post.charge'),
            ],
            '_payments' => $this->user->payments,
            '_amount'   => $this->user->amount ? $this->user->amount->amount : 0,
        ]);
        return view('user.setings.winning');
    }
}
