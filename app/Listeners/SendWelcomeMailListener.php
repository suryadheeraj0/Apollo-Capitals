<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Jobs\SendWelcomeMailJob;
use App\Mail\SendActivationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailListener
{
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $name = $event->name ;
        $dummyPassword = $event->dummyPassword ;
        $activationLink = $event->activationLink ;
        $email = $event->email ;
        SendWelcomeMailJob::dispatch($name, $dummyPassword, $activationLink, $email) ;//->delay(now()->addMinute(5)) ;
    
    }
}
