<?php

namespace App\Listeners;

class PaymentListener
{
    public function onUserDeposit($event)
    {

    }

    public function subscribe($events)
    {
        $events->listen(
            UserCreated::class,
            static::class . '@onUserDeposit'
        );
    }
}
