<?php

namespace App\Charging;

use App\Models\Order;

trait Transaction
{
    public function makeTransaction(Order $order, $amount, $balance, $amount_total, $description)
    {
        return $order->newTransaction()
            ->withType(2)
            ->withAmount($amount)
            ->withAmountPrev($balance)
            ->withAmountTotal($amount_total)
            ->withDescription($description)
            ->publish();
    }
}
