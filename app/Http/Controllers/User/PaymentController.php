<?php

namespace App\Http\Controllers\User;

use App\Events\Payment\UpdatePaymentDefault;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\CreditCardRequest;
use App\Models\Amount;
use App\Models\Payment;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getPayments()
    {
        return $this->user->payments()->latest()->get();
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
        $payment->default        = $request->default;

        $payment->save();

        if ($request->default) {
            event(new UpdatePaymentDefault($user, $payment));
        }
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

        if ($request->default) {
            event(new UpdatePaymentDefault($user, $payment));
        }
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
        $amount = Amount::whereUserId(Auth::user()->id)->first()->amount;
        return view('user.settings.transaction-history', compact('amount'));
    }
}
