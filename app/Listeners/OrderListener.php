<?php

namespace App\Listeners;

use App\Events\Order\OrderDelete;
use App\Events\Order\UpdateStatusEvent;
use App\Events\Order\UserPurchasedTicket;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderListener
{
    public function onUpdateStatus($event)
    {
        $order = $event->order;
        $user  = $order->user;
        Mail::send('mail.order.purchased', ['senderName' => $user->fullname, 'order' => $order, 'logo' => ['path' => asset('css/images/logo.png'), 'width' => 150, 'height' => 150]], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->fullname)->subject(trans('event.title_update_order'));
        });

    }

    public function onOrderDeleted($event)
    {
        $order = $event->order;
        foreach ($order->images as $k => $image) {
            $image->delete();
            Image::deleteImage($image->path);
        }

    }

    public function onOrderEmail($event)
    {
        $order = $event->order;

        $user = Auth::user();

        Mail::send('mail.order.neworder', ['senderName' => $user->fullname, 'order' => $order, 'logo' => ['path' => asset('css/images/logo.png'), 'width' => 150, 'height' => 150]], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->fullname)->subject(trans('event.title_new_order'));
        });

        Mail::send('mail.order.toadmin', ['senderName' => 'Ken,', 'order' => $order], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to('kennj.consultant@gmail.com', 'Ken')->cc('hoadp.vn@gmail.com')->subject($user->fullname . " just bought a ticket");
        });

    }

    public function subscribe($events)
    {
        $events->listen(
            UpdateStatusEvent::class,
            static::class . '@onUpdateStatus'
        );
        $events->listen(
            UserPurchasedTicket::class,
            static::class . '@onOrderEmail'
        );
        $events->listen(
            OrderDelete::class,
            static::class . '@onOrderDeleted'
        );
    }
}
