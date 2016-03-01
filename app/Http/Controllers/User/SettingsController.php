<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        \JavaScript::put([
            '_api' => [
                'user' => route('front::settings.api.account')
            ]
        ]);
    }

    public function getAccount()
    {
        return view('user.setings.account');
    }

    public function getApiAccount()
    {
        return $this->user;
    }
}
