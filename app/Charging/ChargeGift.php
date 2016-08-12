<?php
namespace App\Charging;

use App\Billing\Billing;
use App\Charging\Statusable;
use App\Charging\Transactionable;
use App\Models\Amount;
use App\Models\Promotion;
use App\Models\User;
use Exception;

class ChargeGift implements ChargeInterface
{
    use Transactionable, Statusable;

    public function charge(Billing $billing)
    {
        $order        = $billing->order;
        $user         = $billing->user;
        $balance      = $user->balance;
        $amount       = $billing->calculateAmount();

        try {
            $credit       = $user->credit - $amount;
            $amount_total = $balance;
            $transaction = $this->makeTransaction($order, $amount, $balance, $amount_total,$credit, $billing->description);

            $status = $this->makeStatus($transaction, 'succeeded');

            $amount = $user->updateCredit($user->amount)
                ->withCredit($credit)
                ->publish();

            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
