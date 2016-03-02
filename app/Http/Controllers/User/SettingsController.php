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
                'user' => route('front::settings.api.account'),
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
        ]);
        // return Stripe::customers()->all();
        return view('user.setings.credit-card');
    }
}
