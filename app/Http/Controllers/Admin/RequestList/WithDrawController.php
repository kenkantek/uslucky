<?php

namespace App\Http\Controllers\Admin\RequestList;

use App\Events\Payment\UserClaimEvent;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WithDrawController extends Controller
{
    public function index()
    {
        return view('admin.withdraws.index');
    }

    public function update(Request $request, $id)
    {
        $trans                 = Transaction::with('status')->find($id);
        $trans->status->status = $request->status;
        $user                  = $trans->user;
        if ($request->status == 'succeeded') {
            event(new UserClaimEvent($user, $trans));
        }
        $trans->status->save();
        return $trans;
    }

    public function getTransacsions(Request $request)
    {
        $take         = $request->take ?: 10;
        $transactions = Transaction::with('user')->with('status')
            ->whereType(0)
            ->latest('updated_at')
            ->paginate($take)
            ->appends(['take' => $take]);
        return $transactions;
    }
}
