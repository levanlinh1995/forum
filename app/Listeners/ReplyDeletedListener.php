<?php

namespace App\Listeners;

use App\Events\ReplyDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyDeletedListener implements ShouldQueue
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
     * @param  ReplyDeletedEvent  $event
     * @return void
     */
    public function handle(ReplyDeletedEvent $event)
    {
        //
    }
}
