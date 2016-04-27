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
        if ($event->user->active) {
            return false;
        }

        Mail::send('mail.verify', ['event' => $event->user], function ($m) use ($event) {
            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
            $m->to($event->user->email, $event->user->first_name)->subject(trans('event.register'));
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
