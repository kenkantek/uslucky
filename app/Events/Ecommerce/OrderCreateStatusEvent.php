<?php

namespace App\Events\Ecommerce;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class OrderCreateStatusEvent extends Event
{
    use SerializesModels;

    public $order;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $user)
    {
        $this->order = $order;
        $this->user  = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
