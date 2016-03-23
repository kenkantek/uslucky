<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;
use Illuminate\Http\Request;

class PowerballController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function postPowerball(Request $request)
    {
        // return $request->all();
        $user = $this->user;
        return DB::transaction(function () use ($user, $request) {
            // Save to Order
            $order = $user->newOrder()
            ->withGame(Game::find(1))
            ->withExtra((bool) $request->extra)
            ->withDrawAt(powerballNextTime()['time'])
            ->withDescription($request->description)
            ->publish();

            // Add status
            $order->updateOrNewStatus()
            ->withStatus('wait for purchase')
            ->publish();

            // Save to Ticket
            $order->newMultiTicket($request->tickets);

            // Payment it
            if ($request->method == 1) {
                $this->chargeFromBalance($user, $request);
                //event Email
            } else {
                $this->chargeFromCredit($user, $request);
            }

            return $order;
        });
    }

    // Return $amount
    protected function chargeFromBalance($user, $request)
    {
        $balance       = $user->balance; // prev
        $amount        = $this->calculateAmount($request);
        $balance_total = $balance - $amount;

        $transaction = $user->newTransaction()
            ->withType(2)
            ->withAmount($amount)
            ->withAmountPrev($balance)
            ->withAmountTotal($balance_total)
            ->withDescription($request->description)
            ->publish();

        // Transaction add status
        $status = $transaction->updateOrNewStatus()
            ->withStatus('succeeded')
            ->publish();

        $amount = $user->updateAmount($user->amount)
            ->withAmount($balance_total)
            ->publish();

        return $amount;
    }

    protected function chargeFromCredit($user, $request)
    {
        $balance       = $user->balance; // prev
        $amount        = $this->calculateAmount($request);
        $balance_total = $balance - $amount;
        $payment       = $user->payments()->whereId($request->payment)->first();

        //Charge Stripe
        $charge = Stripe::charges()->create([
            'customer'      => $payment->stripe_id,
            'currency'      => 'USD',
            'amount'        => $amount,
            'description'   => $request->description,
            'receipt_email' => $user->email,
        ]);

        if (!$charge['failure_code']) {
            // Transaction
            $transaction = $payment->newTransaction()
                ->withType(2)
                ->withAmount($amount)
                ->withAmountPrev($balance)
                ->withAmountTotal($balance_total)
                ->withDescription($request->description)
                ->publish();

            // Transaction add status
            $status = $transaction->updateOrNewStatus()
                ->withStatus($charge['status'])
                ->publish();
        }

        return;
    }

    // tinh toan Amount from client
    protected function calculateAmount($request)
    {
        $amount = count($request->tickets) * env('EACH_PER_TICKET');
        if ($request->extra) {
            $amount += count($request->tickets) * env('EXTRA_PER_TICKET');
        }
        return $amount;
    }
}
