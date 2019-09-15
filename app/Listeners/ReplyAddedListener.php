<?php

namespace App\Listeners;

use App\Events\ReplyAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyAddedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReplyAddedEvent  $event
     * @return void
     */
    public function handle(ReplyAddedEvent $event)
    {
        //
    }
}
