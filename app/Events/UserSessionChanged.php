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

class UserSessionChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $type;

    public function __construct($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function broadcastOn(): array
    {
        Log::debug("{$this->message}, {$this->type}");
        return [
            new PrivateChannel('notifications')
        ];
    }

    public function broadcastWith() {
        return [
            'message' => $this->message,
            'type' => $this->type
        ];
    }
}
