<?php

namespace App\Listeners;

use App\Events\AwardEvent;
use Illuminate\Support\Facades\Mail;

class AwardListener
{
    public function onAwardMail($event)
    {
        $ticket = $event->ticket;
        $user   = $ticket->order->user;
        Mail::send('mail.award', ['senderName' => $user->fullname, 'award' => $ticket, 'prizeMoney' => $event->prizeMoney], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->fullname)->subject(trans('event.award'));
        });
    }

    public function subscribe($events)
    {
        $events->listen(
            AwardEvent::class,
            static::class . '@onAwardMail'
        );
    }
}
