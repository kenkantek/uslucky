<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\CreditCardRequest;
use App\Models\Amount;
use App\Models\Payment;
use App\Models\Status;
use App\Models\Transaction;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function putPayment($id, CreditCardRequest $request)
    {
        $user    = $this->user;
        $payment = Payment::findOrFail($id);

        $customer = Stripe::customers()->update($payment->stripe_id, [
            'description' => $request->card_name,
            'source'      => $request->source,
        ]);

        $card = $customer['sources']['data'][0];

        $payment->card_name      = $request->card_name;
        $payment->card_brand     = $card['brand'];
        $payment->month_exp      = $request->month_exp;
        $payment->year_exp       = $request->year_exp;
        $payment->card_last_four = substr($request->card_number, -4);

        $payment->save();
        return $payment;
    }

    public function postPayment(CreditCardRequest $request)
    {
        $user = $this->user;

        $customer = Stripe::customers()->create([
            'email'       => $user->email,
            'description' => $request->card_name,
            'source'      => $request->source,
        ]);

        $card    = $customer['sources']['data'][0];
        $payment = new Payment([
            'stripe_id'      => $card['customer'],
            'card_name'      => $request->card_name,
            'card_brand'     => $card['brand'],
            'card_last_four' => substr($request->card_number, -4),
            'month_exp'      => $request->month_exp,
            'year_exp'       => $request->year_exp,
        ]);
        $user->payments()->save($payment);

        return $payment;
    }

    public function deletePayment($id)
    {
        $payment = Payment::findOrFail($id);
        Stripe::customers()->delete($payment->stripe_id);
        $payment->delete();
        return $payment;
    }

    public function getHistory()
    {
        return view('user.settings.history');
    }

    public function getApiHistory()
    {
        return $histories = $this->user->transactions()->with('status')->latest()->get();
    }

    public function putCancel($id)
    {
        $user = $this->user;
        //Update status transactions
        $status_transaction                 = $user->transactions()->with('status')->whereId($id)->first();
        $status_transaction->status->status = 'canceled';
        $status_transaction->status->save();

        $user_amount = $user->amount;
        $amount_prev = $user_amount ? $user_amount->amount : 0;

        //BEGIN transaction

        return DB::transaction(function () use ($user, $user_amount, $amount_prev, $status_transaction) {
            $amount_total = $amount_prev + $status_transaction->amount;
            //create Transaction
            $transaction = new Transaction([
                'type'         => 1,
                'amount'       => $status_transaction->amount,
                'amount_prev'  => $amount_prev,
                'amount_total' => $amount_total,
                'description'  => "Canceled request payment at " . $status_transaction->created_at,
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
