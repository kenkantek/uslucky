<?php
namespace App\Traits;

use App\Models\Transaction;

trait TransactionTrait
{
    public function newTransaction()
    {
        $transaction = new Transaction;
        $transaction->user()->associate(auth()->user());
        $transaction->transactionable()->associate($this);
        return $transaction;
    }
}
