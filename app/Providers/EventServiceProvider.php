<?php

namespace App\Providers;

use App\Listeners\AwardListener;
use App\Listeners\OrderListener;
use App\Listeners\PaymentListener;
use App\Listeners\UserListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    protected $subscribe = [
        UserListener::class,
        PaymentListener::class,
        OrderListener::class,
        AwardListener::class,
    ];
}
