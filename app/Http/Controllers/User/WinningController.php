<?php

namespace App\Http\Controllers\User;

use App\Events\Payment\UserClaimEvent;
use App\Events\Payment\UserDepositEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ChargeRequest;
use App\Http\Requests\Settings\ClaimRequest;
use App\Models\Amount;
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

            return DB::transaction(function () use ($user, $charge, $amount_prev, $amount_total, $user_amount, $request, $payment) {

                // Create new transaction
                $transaction = $payment->newTransaction()
                ->withType(1)
                ->withAmount($charge['amount'] / 100)
                ->withAmountPrev($amount_prev)
                ->withAmountTotal($amount_total)
                ->withDescription($request->description)
                ->publish();

                // Transaction add status
                $status = $transaction->updateOrNewStatus()
                ->withStatus($charge['status'])
                ->publish();

                // update Amount
                $amount = $user->updateAmount($user_amount)->withAmount($amount_total)->publish();

                event(new UserDepositEvent());

                return $amount->amount;
            });

            //END transaction
        }
        return response(['message' => $charge['failure_message']], 402);
    }

    public function postClaim(ClaimRequest $request)
    {
        $user        = $this->user;
        $user_amount = $user->amount;
        $amount_prev = $user_amount ? $user_amount->amount : 0;
        if ($amount_prev <= $request->amount) {
            return response(['message' => "Your currenttly $amount_prev is less than {$request->amount}."], 400);
        }

        //BEGIN transaction

        return DB::transaction(function () use ($user, $user_amount, $amount_prev, $request) {
            $amount_total = $amount_prev - $request->amount;

            // Create new transaction
            $transaction = $user->newTransaction()
            ->withType(0)
            ->withAmount($request->amount)
            ->withAmountPrev($amount_prev)
            ->withAmountTotal($amount_total)
            ->withDescription($request->description)
            ->publish();

            // Transaction add status
            $status = $transaction->updateOrNewStatus()
            ->withStatus('pendding')
            ->publish();

            // update Amount
            $amount = $user->updateAmount($user_amount)->withAmount($amount_total)->publish();

            event(new UserClaimEvent($user, $transaction));

            return $amount->amount;
        });

        //END transaction
    }
}
