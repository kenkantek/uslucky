<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout', 'getVerify', 'getReSendEmail']);
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }
}
