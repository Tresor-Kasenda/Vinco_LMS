<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public $message
    ) {
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): \Illuminate\Broadcasting\Channel|array
    {
        return new PrivateChannel('message-channel');
    }

    public function broadcastWith(): array
    {
        return ['message' => $this->message];
    }
}
