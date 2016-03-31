<?php

namespace App\Listeners;

use App\Events\AwardEvent;
use Illuminate\Support\Facades\Mail;

class AwardListener
{
    public function onAwardMail($event)
    {
        $award = $event;
        $user  = $event->order->user;
        Mail::send('mail.award', ['senderName' => $user->fullname, 'award' => $award], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->fullname)->subject("You are WINNER! Congratulation from USLUCKY");
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
