<?php

namespace App\Listeners;

use App\Events\Payment\UserClaimEvent;
use App\Events\Payment\UserDepositEvent;
use Mail;

class PaymentListener
{
    public function onUserDeposit($event)
    {

    }

    public function onUserClaim($event)
    {
        $user        = $event->user;
        $transaction = $event->transaction;

        Mail::send('mail.payments.claim', ['senderName' => $user->fullname, 'transaction' => $transaction, 'logo' => ['path' => 'http://www.dadafest.co.uk/wp-content/uploads/2011/12/big-lottery-fund-logo.gif', 'width' => 150, 'height' => 150]], function ($m) use ($user, $transaction) {
            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
            $m->to($user->email, $user->fullname)->subject("US Lucky Preview Payment transaction #{$transaction->id}");
        });
    }

    public function subscribe($events)
    {
        $events->listen(
            UserDepositEvent::class,
            static::class . '@onUserDeposit'
        );

        $events->listen(
            UserClaimEvent::class,
            static::class . '@onUserClaim'
        );
    }
}
