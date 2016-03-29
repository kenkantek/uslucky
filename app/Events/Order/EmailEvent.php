<?php

namespace App\Events\Order;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class EmailEvent extends Event
{
    use SerializesModels;
    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;}

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
