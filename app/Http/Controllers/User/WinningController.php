<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ChargeRequest;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class WinningController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function postCharge(ChargeRequest $request)
    {
        $payment = $this->user->payments()->find($request->payment);

        if (!$payment) {
            return response(['message' => 'Payment failed!'], 402);
        }

        $charge = Stripe::charges()->create([
            'customer' => $payment->stripe_id,
            'currency' => 'USD',
            'amount'   => $request->amount,
        ]);

        return $charge;
    }
}
