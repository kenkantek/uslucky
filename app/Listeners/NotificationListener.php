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
            $body    = "Your order #{$order->id} at  {$order->created_at}  was purchased. Please check by Your order menu.";

        } else if ($order->status->status == 'canceled') {
            $subject = 'canceled';
            $body    = "Because your order #{$order->id} at {$order->created_at} was canceled. We refund to you. Total amount: $ " . number_format($order->price) . " .";
        }

        isset($subject) && $order->user->makeNotification($subject, $body, $order);
    }

    public function onClaimRequest($event)
    {
        $trans = $event->trans;
        $body  = "Your claim request #{$trans->id} at {$trans->created_at} was paid. Total amount: $ " . number_format($trans->amount) . ".";

        $trans->user->makeNotification('claimrequest', $body, $trans);
    }

    public function onWinner($event)
    {
        $ticket = $event->ticket;
        $body   = "You are WINNER with ticket number: <strong> " . join(" ", $ticket->numbers) . "  <span style='color: red'>{$ticket->ball}</span></strong>. Prize: {$ticket->level->label} with $ " . number_format($event->prizeMoney) . " .";

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
