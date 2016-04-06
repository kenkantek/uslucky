<?php

namespace App\Events\Order;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserPurchasedTicket extends Event
{
    use SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return [];
    }
}
