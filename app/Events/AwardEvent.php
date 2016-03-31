<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class AwardEvent extends Event
{
    use SerializesModels;

    public $ticket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
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
