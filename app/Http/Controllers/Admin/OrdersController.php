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

    public function show(Order $orders)
    {
        \Javascript::put([
            'order_id' => $orders->id,
        ]);

        return view('admin.orders.show', compact('orders'));
    }

    public function getOrders(Request $request)
    {
        $keyword = $request->keyword ?: '';
        $take    = $request->take ?: 10;
        return Order::search($keyword)
            ->with('user')
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }

    public function getOrder(Order $order)
    {
        return $order->load('tickets.status');
    }

}
