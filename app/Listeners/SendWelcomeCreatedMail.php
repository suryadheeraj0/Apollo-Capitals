<?php

namespace App\Listeners;

use App\Events\WelcomeMailEvent;
use App\Jobs\SendAccountSuccessMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeCreatedMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WelcomeMailEvent $event): void
    {
        $user = $event->user ;
        SendAccountSuccessMail::dispatch($user) ;
    }
}
