<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getIndex()
    {
        return view('user.settings.order');
    }

    public function getTicket($orderId)
    {
        return view('user.settings.ticket', compact('orderId'));
    }

    public function getApiOrder($take = 10)
    {
        $orders = Order::with('game')->whereUserId(Auth::user()->id)->latest('created_at')->paginate($take);
        return $orders;
    }

    public function getApiTicket($id, $take = 10)
    {
        $ticket = Ticket::with('order')->with('status')->whereOrderId($id)->paginate($take);
        return $ticket;
    }
}
