<?php

namespace App\Listeners;

use App\Events\Ecommerce\OrderUpdateStatusEvent;
use Mail;

class OrderEcommerceListener
{
    public function onOrderUpdateStatus($event)
    {
        $order = $event->order;
        $user  = $order->user;
        Mail::send('mail.ecommerce.orders.update-status', compact(['order', 'user']), function ($m) use ($user) {

            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));

            $m->to($user->email, $user->fullname)->subject(trans('event.title_update_order'));
        });

    }

    public function subscribe($events)
    {
        $events->listen(
            OrderUpdateStatusEvent::class,
            static::class . '@onOrderUpdateStatus'
        );
    }
}
