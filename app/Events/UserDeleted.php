<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    /**
     * Create a new event instance.
     */
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::debug("Deleted {$this->user->name}");
        return [
            new Channel('user-deleted-channel'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'message' => 'User has been deleted successfully',
            'user' => $this->user
        ];
    }
}
