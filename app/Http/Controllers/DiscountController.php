<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function applyGameDiscount($game, Request $request)
    {
        $now = Carbon::today()->toDateString();

        return Discount::whereCode($request->coupon)
            ->whereActive(true)
            ->whereDate('begin_at', '<=', $now)
            ->whereDate('end_at', '>=', $now)
            ->whereHas('games', function ($q) use ($game) {
                $q->whereId($game);
            })
            ->first();
    }
}
