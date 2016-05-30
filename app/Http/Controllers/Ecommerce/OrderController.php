<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;

class OrderController extends Controller
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
