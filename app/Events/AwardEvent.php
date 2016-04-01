<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Ticket;
use Illuminate\Queue\SerializesModels;

class AwardEvent extends Event
{
    use SerializesModels;

    public $ticket, $prizeMoney;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, $prizeMoney)
    {
        $this->ticket     = $ticket;
        $this->prizeMoney = $prizeMoney;
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
