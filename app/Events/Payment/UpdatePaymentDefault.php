<?php

namespace App\Events\Payment;

use App\Events\Event;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UpdatePaymentDefault extends Event
{
    use SerializesModels;

    public $user;
    public $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Payment $payment)
    {
        $this->user    = $user;
        $this->payment = $payment;
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
