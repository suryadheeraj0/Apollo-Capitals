<?php

namespace App\Listeners;

use App\Events\PasswordExpiredEvent;
use App\Jobs\PasswordExpiredSendMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PasswordExpiredListener
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
    public function handle(PasswordExpiredEvent $event): void
    {
        $name = $event->name ; 
        $email = $event->email ;
        PasswordExpiredSendMailJob::dispatch($name, $email) ;
    }
}
