<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TestMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }
    
    public function broadcastOn(): array
    {
        Log::debug("{$this->user->name}: {$this->message}");
        return [
            new Channel('chat'),
        ];
    }

    public function broadcastWith(): array {
        return [
            'user' => $this->user,
            'message' => $this->message
        ];
    }
}
