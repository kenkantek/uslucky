<?php

namespace App\Listeners;

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
        $user  = Auth::user()->whereId($order->user_id)->first();
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

    public function subscribe($events)
    {
        $events->listen(
            UpdateStatusEvent::class,
            static::class . '@onUpdateStatus'
        );
        $events->listen(
            OrderDelete::class,
            static::class . '@onOrderDeleted'
        );
    }
}
