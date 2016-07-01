<?php

namespace App\Charging;

use App\Models\Transaction;

trait Statusable
{
    public function makeStatus(Transaction $transaction, $status)
    {
        return $transaction->updateOrNewStatus()
            ->withStatus($status)
            ->publish();
    }
}
