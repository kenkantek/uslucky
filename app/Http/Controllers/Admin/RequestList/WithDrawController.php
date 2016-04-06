<?php

namespace App\Http\Controllers\Admin\RequestList;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class WithDrawController extends Controller
{
    public function index()
    {
        return view('admin.withdraws.index');
    }

    public function getTransacsions($take = 10)
    {
        $transactions = Transaction::with('user')->with('status')->whereType(0)->latest('updated_at')->paginate($take);
        return $transactions;
    }
}
