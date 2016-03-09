<?php

namespace App\Events\Payment;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserClaimEvent extends Event
{
    use SerializesModels;

    public $user;
    public $transaction;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $transaction)
    {
        $this->user        = $user;
        $this->transaction = $transaction;
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
