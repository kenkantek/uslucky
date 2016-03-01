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
        return view('user.setings.account');
    }
}
