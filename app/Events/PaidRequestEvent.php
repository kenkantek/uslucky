<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class PaidRequestEvent extends Event
{
    use SerializesModels;

    public $trans;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trans, $user)
    {
        $this->trans = $trans;
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
