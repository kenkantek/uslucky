<?php

namespace App\Listeners;

use App\Events\Order\UpdateStatusEvent;

class NotificationListener
{
    public function onAdminUpdatedOrder($event)
    {
        $order = $event->order;
        if ($order->status->status !== 'wait for purchase') {
            $notify = $order->user->newNotification()
                ->withSubject('subject be')
                ->withBody('body ne')
                ->withObjectType($order)
                ->publish();
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            UpdateStatusEvent::class,
            static::class . '@onAdminUpdatedOrder'
        );
    }
}
