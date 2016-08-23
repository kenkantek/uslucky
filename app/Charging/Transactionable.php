<?php

namespace App\Charging;

use App\Models\Affiliate;
use App\Models\AffiliateTransaction;
use App\Models\Amount;
use App\Models\Order;
use App\Models\Transaction;

trait Transactionable
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
