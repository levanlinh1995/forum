<?php

namespace App\Listeners;

use App\Events\LikeReplyEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LikeReplyListener implements ShouldQueue
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
     * @param  LikeReplyEvent  $event
     * @return void
     */
    public function handle(LikeReplyEvent $event)
    {
        //
    }
}
