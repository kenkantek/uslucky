<?php

namespace App\Http\Controllers\User;

use App\Events\Order\UpdateStatusEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use DB;
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
        return $order->load(['tickets' => function ($q) {
            $q->with('status', 'award.level');
        }, 'status', 'user', 'images' => function ($q) {
            $q->latest('id');
        }]);
    }

    public function cancleOrder(Order $order)
    {
        return DB::transaction(function () use ($order) {

            $order->updateOrNewStatus($order->status)
            ->withStatus('canceled')
            ->publish();

            $order->refundOrder();
            event(new UpdateStatusEvent($order));
            return "Account Refund \${$order->price}";
        });

    }
}
