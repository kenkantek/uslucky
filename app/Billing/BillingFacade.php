<?php

namespace App\Billing;

use DB;

class BillingFacade
{
    private $billing;

    public function __construct(BillingInterface $billing)
    {
        $this->billing = $billing;
    }

    public function save()
    {
        return DB::transaction(function () {
            $order = $this->billing->newOrder();

            $this->billing->applyStatus($order);

            $this->billing->saveTickets($order);

            $charge = $this->billing->charge();

            $this->billing->fireEvents();

            return $charge === true ? $order : response(['message' => $charge], 400);

        });

    }

}
