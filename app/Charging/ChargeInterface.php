<?php
namespace App\Charging;

use App\Billing\Billing;

interface ChargeInterface
{
    public function charge(Billing $billing);
}
