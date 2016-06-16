<?php
namespace App\Charging;

use App\Billing\Billing;
use App\Charging\Status;
use App\Charging\Transaction;
use App\Models\User;
use Exception;

class ChargeBalance implements ChargeInterface
{
    use Transaction, Status;

    public function charge(Billing $billing)
    {
        $order        = $billing->order;
        $user         = $billing->user;
        $balance      = $user->balance;
        $amount       = $billing->calculateAmount();
        $amount_total = $balance - $amount;

        try {

            $transaction = $this->makeTransaction($order, $amount, $balance, $amount_total, $billing->description);

            $status = $this->makeStatus($transaction, 'succeeded');

            $amount = $user->updateAmount($user->amount)
                ->withAmount($amount_total)
                ->publish();

            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
