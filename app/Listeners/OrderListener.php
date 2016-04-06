<?php

namespace App\Listeners;

use App\Events\Order\EmailEvent;
use App\Events\Order\OrderDelete;
use App\Events\Order\UpdateStatusEvent;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderListener
{
    public function onUpdateStatus($event)
    {
        $order = $event->order;
        $user  = $order->user;
        Mail::send('mail.order.purchased', ['senderName' => $user->fullname, 'order' => $order, 'logo' => ['path' => 'http://www.dadafest.co.uk/wp-content/uploads/2011/12/big-lottery-fund-logo.gif', 'width' => 150, 'height' => 150]], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->fullname)->subject(env('TITLE') . " - Your order was purchased");
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
        $user  = Auth::user();
        Mail::send('mail.order.neworder', ['senderName' => $user->fullname, 'order' => $order, 'logo' => ['path' => 'http://www.dadafest.co.uk/wp-content/uploads/2011/12/big-lottery-fund-logo.gif', 'width' => 150, 'height' => 150]], function ($m) use ($user) {
            $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $m->to($user->email, $user->fullname)->subject("Your new order from USLUCKY");
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
            EmailEvent::class,
            static::class . '@onOrderEmail'
        );
        $events->listen(
            OrderDelete::class,
            static::class . '@onOrderDeleted'
        );
    }
}
