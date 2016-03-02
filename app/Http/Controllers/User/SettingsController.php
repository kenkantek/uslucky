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
                'user' => route('front::settings.api.account'),
                'put_account' => route('front::account.put.account'),
                'put_avatar' => route('front::account.avatar')
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
