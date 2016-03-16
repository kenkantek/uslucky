<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Amount;
use App\Models\Status;
use App\Models\Transaction;
use DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getTransactions($take = 10)
    {
        return $this->user->transactions()->with('status')->latest('updated_at')->paginate($take);
    }

    public function putCancel($id)
    {
        $user = $this->user;
        //Update status transactions
        $status_transaction                 = $user->transactions()->with('status')->whereId($id)->first();
        $status_transaction->status->status = 'canceled';

        $user_amount = $user->amount;
        $amount_prev = $user_amount ? $user_amount->amount : 0;

        //BEGIN transaction

        return DB::transaction(function () use ($user, $user_amount, $amount_prev, $status_transaction) {
            $status_transaction->status->save();
            $amount_total = $amount_prev + $status_transaction->amount;
            //create Transaction
            $transaction = new Transaction([
                'type'         => 1,
                'amount'       => $status_transaction->amount,
                'amount_prev'  => $amount_prev,
                'amount_total' => $amount_total,
                'description'  => "Canceled request of transaction <a href='#transaction-{$status_transaction->id}'>#{$status_transaction->id}</a>.",
            ]);

            $user->transactions()->save($transaction);

            // Transaction add status
            $status = new Status;
            $status->withStatus('succeeded')->regarding($transaction)->save();
            $transaction->status()->save($status);

            // update Amount
            $amount         = $user_amount ? $user_amount : new Amount;
            $amount->amount = $amount_total;
            $amount->user()->associate($user);
            $amount->save();

            return $amount->amount;
        });

        //END transaction
        return $status;
    }
}
