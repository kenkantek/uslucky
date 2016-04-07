<?php

namespace App\Listeners;

use App\Events\AwardEvent;
use App\Events\Order\UpdateStatusEvent;
use App\Events\PaidRequestEvent;

class NotificationListener
{
    public function onAdminUpdatedOrder($event)
    {
        $order = $event->order;
        if ($order->status->status == 'purchased') {
            $notify = $order->user->newNotification()
                ->withSubject('purchased')
                ->withBody('Your order #' . $order->id . ' at ' . $order->created_at . ' was purchased. Please check by Your order menu.')
                ->withObjectType($order)
                ->publish();
        } else if ($order->status->status == 'canceled') {
            $notify = $order->user->newNotification()
                ->withSubject('canceled')
                ->withBody('Because your order #' . $order->id . ' at ' . $order->created_at . ' was canceled. We refund to you. Total amount: $' . number_format($order->price) . '.')
                ->withObjectType($order)
                ->publish();
        }
    }

    public function onClaimRequest($event)
    {
        $trans  = $event->trans;
        $notify = $trans->user->newNotification()
            ->withSubject('claimrequest')
            ->withBody('Your claim request #' . $trans->id . ' at ' . $trans->created_at . ' was paid. Total amount: $' . number_format($trans->amount) . '.')
            ->withObjectType($trans)
            ->publish();
    }

    public function onWinner($event)
    {
        $winner = $event->ticket;
        $number = "";
        foreach ($winner->numbers as $value) {
            $number = $number . $value . " ";
        }
        $notify = $winner->order->user->newNotification()
            ->withSubject('award')
            ->withBody('You are WINNER with ticket number: <b>' . $number . ' <span style="color: red">' . $winner->ball . '</span></b>. Prize: ' . $winner->level->label . ' with $' . number_format($event->prizeMoney) . '.')
            ->withObjectType($winner)
            ->publish();
    }

    public function subscribe($events)
    {
        $events->listen(
            UpdateStatusEvent::class,
            static::class . '@onAdminUpdatedOrder'
        );

        $events->listen(
            PaidRequestEvent::class,
            static::class . '@onClaimRequest'
        );

        $events->listen(
            AwardEvent::class,
            static::class . '@onWinner'
        );
    }
}
