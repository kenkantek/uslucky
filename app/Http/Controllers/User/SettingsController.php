<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Javascript;

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
        JavaScript::put([
            '_countries'  => file_get_contents(storage_path('countries.json')),
            '_changepass' => route('front::account.put.changepass'),
        ]);
        return view('user.settings.account');
    }

    public function getApiAccount()
    {
        return $this->user;
    }

    public function getPayment()
    {
        JavaScript::put([
            '_stripe'   => [
                'key' => config('services.stripe.key'),
            ],
            '_date'     => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
            ],
            '_payments' => $this->user->payments,
        ]);

        return view('user.settings.credit-card');
    }

    public function getWinning()
    {
        JavaScript::put([
            '_payments'       => $this->user->payments,
            '_amount'         => $this->user->amount ? $this->user->amount->amount : 0,
            '_minimum_amount' => env('MINIMUM_AMOUNT'),
        ]);
        return view('user.settings.winning');
    }
}
