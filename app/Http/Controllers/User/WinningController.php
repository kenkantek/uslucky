<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class WinningController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
}
