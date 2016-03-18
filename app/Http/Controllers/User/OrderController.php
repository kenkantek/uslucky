<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getIndex($take = 10)
    {
        $orders = Order::with('game')->whereUserId(Auth::user()->id)->latest('created_at')->paginate($take);
        return $orders;
    }
}
