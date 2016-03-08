<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Mail;

class UserListener
{

    /**
     * @param $event
     */
    public function onUserCreated($event)
    {
        Mail::send('mail.verify', ['event' => $event->user], function ($m) use ($event) {
            $m->from('hello@app.com', 'Verify Your Email Address From US Lucky');

            $m->to($event->user->email, $event->user->first_name)->subject('Verify Your Email Address');
        });
    }

    public function subscribe($events)
    {
        $events->listen(
            UserCreated::class,
            static::class . '@onUserCreated'
        );
    }
}
