<?php

namespace App\Http\Controllers\Admin\RequestList;

use App\Events\PaidRequestEvent;
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
            event(new PaidRequestEvent($trans, $user));
        }
        $trans->status->save();
        return $trans;
    }

    public function getTransacsions(Request $request)
    {
        $take         = $request->take ?: 10;
        $status       = $request->status;
        $transactions = Transaction::with('user')->with('status')->whereHas('status', function ($q) use ($status) {
            $q->where('status', $status);
        })
            ->whereType(0)
            ->latest('updated_at')
            ->paginate($take)
            ->appends(['take' => $take, 'status' => $status]);

        return $transactions;
    }
}
