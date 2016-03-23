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
        return Order::search($request->keyword ?: '')
            ->with('user')
            ->latest()
            ->paginate($request->take ?: 10);
    }

}
