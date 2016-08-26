<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Game;
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

    public function getPayment()
    {
        JavaScript::put([
            '_stripe' => [
                'key' => config('services.stripe.key'),
            ],
            '_date'   => [
                'month' => generateMonth(),
                'year'  => generateYear(15),
            ],
        ]);

        return view('user.settings.credit-card');
    }

    public function getWinning()
    {
        JavaScript::put([
            '_games' => Game::all(),
        ]);
        return view('user.settings.winning');
    }

    public function getNotifications()
    {
        return view('user.settings.notification');
    }

    public function getAffiliate()
    {
        $code = Affiliate::where('user_id',\Auth::user()->id)->first();
        return view('user.settings.affiliate',compact('code'));
    }
}
