<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\CreditCardRequest;
use App\Models\Payment;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

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
        return view('user.settings.transaction-history');
    }
}
