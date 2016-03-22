<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.orders.index');
    }

    public function getOrders(Request $request)
    {
        $take = $request->take ?: 10;
        return Order::with('user')->latest()->paginate($take);
    }
}
