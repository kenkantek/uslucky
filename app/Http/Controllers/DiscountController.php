<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function applyGameDiscount($game, Request $request)
    {
        $dicount = Discount::whereCode($request->coupon)
            ->whereActive(true)
            ->whereHas('games', function ($q) use ($game) {
                $q->whereId($game);
            })
            ->first();

        return $dicount;
    }
}
