<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AlipayController extends Controller
{
    public function postAlipay(Request $request)
    {
        $stripe = [
            'secret_key'      => env('STRIPE_SECRET'),
            'publishable_key' => env('STRIPE_KEY'),
        ];

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

// Get the Alipay token submitted by Checkout
//        $token = $t->id;

// Create the charge on Stripe's servers - this will charge the user's Alipay account
        try {
            $charge = \Stripe\Charge::create([
                "amount"      => $request->total, // amount in cents, again
                "currency"    => "usd",
                "source"      => $request->atoken,
                "description" => $request->description,
            ]);
            echo $charge;
        } catch (\Stripe\Error\Card $e) {
            echo $e->getMessage();
        }
    }
}
