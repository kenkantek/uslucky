<?php
namespace App\Charging;

use App\Billing\Billing;
use App\Models\User;
use Exception;

class ChargeBalance implements ChargeInterface
{
    public function charge(Billing $billing)
    {
        $user         = $billing->user;
        $balance      = $user->balance;
        $amount       = $billing->calculateAmount();
        $amount_total = $balance - $amount;

        try {
            $transaction = $user->newTransaction()
                ->withType(2)
                ->withAmount($amount)
                ->withAmountPrev($balance)
                ->withAmountTotal($amount_total)
                ->withDescription($billing->description)
                ->publish();

            // Transaction add status
            $status = $transaction->updateOrNewStatus()
                ->withStatus('succeeded')
                ->publish();

            $amount = $user->updateAmount($user->amount)
                ->withAmount($amount_total)
                ->publish();

            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
