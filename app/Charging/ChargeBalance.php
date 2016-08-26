<?php
namespace App\Charging;

use App\Billing\Billing;
use App\Charging\Statusable;
use App\Charging\Transactionable;
use App\Models\Amount;
use App\Models\Promotion;
use App\Models\User;
use Exception;

class ChargeBalance implements ChargeInterface
{
	use Transactionable, Statusable;

	public function charge(Billing $billing)
	{
		$order        = $billing->order;
		$user         = $billing->user;
		$balance      = $user->balance;
		$amount       = $billing->calculateAmount();
		$amount_total = $balance - $amount;

		try {
			$min_pro = Promotion::first();
			if ($min_pro->status==1) {
				if ($amount >= $min_pro->amount) {
					$credit         = Amount::where('user_id', \Auth::user()->id)->firstOrNew(['user_id' => \Auth::user()->id]);
					$credit->credit = $credit->credit + 2;
					$credit->save();
				}
			}

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
