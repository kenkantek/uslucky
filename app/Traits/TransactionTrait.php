<?php
namespace App\Traits;

use App\Models\Transaction;
use App\Models\User;

trait TransactionTrait
{
    public function newTransaction(User $user = null)
    {
        $transaction = new Transaction;
        $transaction->user()->associate($user ?: auth()->user());
        $transaction->transactionable()->associate($this);
        return $transaction;
    }
}
