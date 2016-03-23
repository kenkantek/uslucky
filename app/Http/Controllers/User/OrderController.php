<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.orders.index');
    }

    public function show($id)
    {
        \Javascript::put([
            'order_id' => $id,
        ]);
        return view('user.orders.show');
    }

    public function getOrders(Request $request)
    {
        $take = $request->take;
        return $this->user->orders()->with(['game', 'status'])->latest()->paginate($take);
    }

    public function getOrder(Order $order)
    {
        return $order->load(['tickets.status', 'status']);
    }
}
