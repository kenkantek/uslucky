<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
