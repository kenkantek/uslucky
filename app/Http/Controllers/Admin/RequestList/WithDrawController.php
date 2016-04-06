<?php

namespace App\Http\Controllers\Admin\RequestList;

use App\Http\Controllers\Controller;

class WithDrawController extends Controller
{
    public function index()
    {
        return view('admin.withdraws.index');
    }
}
