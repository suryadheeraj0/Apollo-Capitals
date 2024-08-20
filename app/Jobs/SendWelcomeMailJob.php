<?php

namespace App\Jobs;

use App\Mail\SendActivationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $name ;
    public $dummyPassword ;
    public $activationLink ;
    public $email ;

    /**
     * Create a new job instance.
     */
    public function __construct($name, $dummyPassword, $activationLink, $email)
    {
        $this->name = $name ;
        $this->dummyPassword = $dummyPassword ;
        $this->activationLink = $activationLink ;
        $this->email = $email ;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $name = $this->name ;
        $dummyPassword = $this->dummyPassword ;
        $activationLink = $this->activationLink ;
        $email = $this->email ;
        Mail::send(new SendActivationEmail($name, $dummyPassword, $activationLink, $email)) ;
    }
}
