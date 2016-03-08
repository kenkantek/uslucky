<?php

namespace App\Http\Controllers\User;

use App\Events\UserDepositEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ChargeRequest;
use App\Models\Amount;
use App\Models\Status;
use App\Models\Transaction;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;

class WinningController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function postCharge(ChargeRequest $request)
    {
        $user    = $this->user;
        $payment = $user->payments()->find($request->payment);

        if (!$payment) {
            return response(['message' => 'Payment failed!'], 402);
        }

        $charge = Stripe::charges()->create([
            'customer'      => $payment->stripe_id,
            'currency'      => 'USD',
            'amount'        => $request->amount,
            'description'   => $request->description,
            'receipt_email' => $user->email,
        ]);

        if (!$charge['failure_code']) {
            $user_amount  = $user->amount;
            $amount_prev  = $user_amount ? $user_amount->amount : 0;
            $amount_total = $amount_prev + ($charge['amount'] / 100);

            //BEGIN transaction

            return DB::transaction(function () use ($user, $charge, $amount_prev, $amount_total, $user_amount, $request) {
                //create Transaction
                $transaction = new Transaction([
                    'type'         => 1,
                    'amount'       => $charge['amount'] / 100,
                    'amount_prev'  => $amount_prev,
                    'amount_total' => $amount_total,
                    'description'  => $request->description,
                ]);

                $user->transactions()->save($transaction);

                // Transaction add status
                $status = new Status;
                $status->withStatus($charge['status'])->regarding($transaction)->save();
                $transaction->status()->save($status);

                // update Amount
                $amount = $user_amount ? $user_amount : new Amount;
                $amount->amount = $amount_total;
                $amount->user()->associate($user);
                $amount->save();

                event(new UserDepositEvent());

                return $amount->amount;
            });

            //END transaction
        }
        return response(['message' => $charge['failure_message']], 402);
    }
}
