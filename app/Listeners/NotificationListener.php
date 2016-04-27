<?php

namespace App\Listeners;

use App\Events\AwardEvent;
use App\Events\Order\UpdateStatusEvent;
use App\Events\PaidRequestEvent;
use App\Models\User;

class NotificationListener
{
    public function onAdminUpdatedOrder($event)
    {
        $order = $event->order;
        if ($order->status->status == 'purchased') {
            $subject = 'purchased';
            $body    = trans('event.updated_order', [
                'order_id'   => $order->id,
                'created_at' => $order->created_at,
            ]);
        } else if ($order->status->status == 'canceled') {
            $subject = 'canceled';
            $body    = trans('event.order_cancle', [
                'order_id'   => $order->id,
                'created_at' => $order->created_at,
                'price'      => number_format($order->price),
            ]);
        }

        isset($subject) && $order->user->makeNotification($subject, $body, $order);
    }

    public function onClaimRequest($event)
    {
        $trans = $event->trans;
        $body  = trans('event.claim', [
            'transaction' => $trans->id,
            'created_at'  => $trans->created_at,
            'amount'      => number_format($trans->amount),
        ]);

        $trans->user->makeNotification('claimrequest', $body, $trans);
    }

    public function onWinner($event)
    {
        $ticket = $event->ticket;
        $body   = trans('event.winner', [
            'tickets' => join(" ", $ticket->numbers),
            'ball'    => $ticket->ball,
            'label'   => $ticket->level->label,
            'reward'  => number_format($event->prizeMoney),
        ]);

        $ticket->order->user->makeNotification('award', $body, $ticket);
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
