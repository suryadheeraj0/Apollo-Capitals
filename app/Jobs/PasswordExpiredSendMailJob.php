<?php

namespace App\Jobs;

use App\Mail\PasswordExpiredMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PasswordExpiredSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name ;
    public $email ;
    /**
     * Create a new job instance.
     */
    public function __construct($name, $email)
    {
        $this->name = $name ;
        $this->email = $email ;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new PasswordExpiredMail($this->name, $this->email)) ;
    }
}
