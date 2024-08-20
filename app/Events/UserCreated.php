<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name ;
    public  $dummyPassword ; 
    public $activationLink ;
    public $email ;
    /**
     * Create a new event instance.
     */
    public function __construct($name, $dummyPassword, $activationLink, $email)
    {
        $this->name = $name ;
        $this->dummyPassword = $dummyPassword ;
        $this->activationLink = $activationLink ;
        $this->email = $email ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
