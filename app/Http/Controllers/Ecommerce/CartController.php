<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getIndex()
    {
        return view('cart.cart');
    }

    public function postCheckout(Request $request)
    {
        return view('cart.checkout');
    }
}
