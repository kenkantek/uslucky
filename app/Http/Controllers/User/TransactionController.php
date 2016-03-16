<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Amount;
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
        $user        = $this->user;
        $user_amount = $user->amount;
        $amount_prev = $user_amount ? $user_amount->amount : 0;

        //BEGIN transaction

        return DB::transaction(function () use ($id, $user, $user_amount, $amount_prev) {
            $transaction_need_update = $user->transactions()->with('status')->whereId($id)->first();
            $amount_total = $amount_prev + $transaction_need_update->amount;
            //Update status transactions
            $status = $transaction_need_update->updateOrNewStatus($transaction_need_update->status)
            ->withStatus('canceled')
            ->regarding($transaction_need_update)
            ->publish();

            // Create new transaction
            $transaction = $user->newTransaction()
            ->withType(1)
            ->withAmount($transaction_need_update->amount)
            ->withAmountPrev($amount_prev)
            ->withAmountTotal($amount_total)
            ->withDescription("Canceled request of transaction <a href='#transaction-{$transaction_need_update->id}'>#{$transaction_need_update->id}</a>.")
            ->publish();

            // Transaction add new status
            $status = $transaction->updateOrNewStatus()
            ->withStatus('succeeded')
            ->regarding($transaction)
            ->publish();

            // update Amount
            $amount = $user->updateAmount($user_amount)->withAmount($amount_total)->publish();

            return $amount->amount;
        });

        //END transaction
        return $status;
    }
}
