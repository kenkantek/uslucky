<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getIndex($take = 10)
    {
        $orders = Order::with('game')->whereUserId(Auth::user()->id)->latest('created_at')->paginate($take);
        return $orders;
    }

    public function getTicket($id, $take = 10)
    {
        $tickets = Ticket::whereOrderId('id')->get();
        return $tickets;
    }
}
