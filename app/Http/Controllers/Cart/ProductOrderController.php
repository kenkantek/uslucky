<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductOrderController extends Controller
{
    public function index()
    {
        return view('cart.orders.orders');
    }

    public function show($id)
    {
        return view('cart.orders.show');
    }
}
