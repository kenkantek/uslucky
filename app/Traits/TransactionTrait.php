<?php
namespace App\Traits;

use App\Models\Transaction;

trait TransactionTrait
{
    public function newTransaction()
    {
        $transaction = new Transaction;
        $transaction->user()->associate($this);
        $transaction->transactionable()->associate($this);
        return $transaction;
    }
}
