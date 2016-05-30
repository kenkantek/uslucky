<?php

namespace App\Http\Controllers\Admin\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.products.index');
    }
    
    public function show($id)
    {
        return view('admin.orders.products.show');
    }
}
