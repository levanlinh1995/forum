<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\LikeReplyEvent;
use App\Events\ReplyAddedEvent;
use App\Events\ReplyDeletedEvent;
use App\Listeners\LikeReplyListener;
use App\Listeners\ReplyAddedListener;
use App\Listeners\ReplyDeletedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LikeReplyEvent::class => [
            LikeReplyListener::class,
        ],
        ReplyAddedEvent::class => [
            ReplyAddedListener::class
        ],
        ReplyDeletedEvent::class => [
            ReplyDeletedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
