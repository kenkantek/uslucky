<?php

namespace App\Listeners;

use App\Events\PaidRequestEvent;
use App\Events\Payment\UpdatePaymentDefault;
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

        Mail::send('mail.payments.claim', ['senderName' => $user->fullname, 'transaction' => $transaction, 'logo' => ['path' => asset('css/images/logo.png'), 'width' => 150, 'height' => 150]], function ($m) use ($user, $transaction) {
            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
            $m->to($user->email, $user->fullname)->subject(trans('event.title_claim', ['transaction' => $transaction->id]));
        });
    }

    public function onPaidRequest($event)
    {
        $transaction = $event->trans;
        $user        = $event->user;

        Mail::send('mail.payments.paid', ['senderName' => $user->fullname, 'transaction' => $transaction, 'logo' => ['path' => asset('css/images/logo.png'), 'width' => 150, 'height' => 150]], function ($m) use ($user, $transaction) {
            $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
            $m->to($user->email, $user->fullname)->subject(trans('event.title_paid', ['transaction' => $transaction->id]));
        });
    }

    public function onChagePaymentDefault($event)
    {
        $user    = $event->user;
        $payment = $event->payment;
        $user->payments()->update(['default' => 0]);
        $payment->default = 1;
        $payment->save();
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

        $events->listen(
            UpdatePaymentDefault::class,
            static::class . '@onChagePaymentDefault'
        );

        $events->listen(
            PaidRequestEvent::class,
            static::class . '@onPaidRequest'
        );
    }
}
