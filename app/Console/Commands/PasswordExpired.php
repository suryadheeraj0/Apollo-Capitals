<?php

namespace App\Console\Commands;

use App\Events\PasswordExpiredEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class PasswordExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:password-expired';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Password expiry after 30 days, if the user didn't change the password in past 30 days";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('password_changed_at', '<', now()->subDays(30))->orWhereNull('password_changed_at')->get();

        foreach($users as $user) {
            info('inside command foreach loop') ;
            $hasedPassword = Hash::make(fake()->password(5, 8)) ;
            $name = $user->name ;
            $email = $user->email ;
            event(new PasswordExpiredEvent($name, $email)) ;
            $user->password = $hasedPassword ;
        }

    }
}
