<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userId;
    public $mentorId;
    public $senderType;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $userId, $mentorId, $senderType)
    {
        $this->message = $message;
        $this->userId = $userId;
        $this->mentorId = $mentorId;
        $this->senderType = $senderType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Saluran pribadi untuk user dan mentor yang terlibat dalam chat ini
        // Agar hanya user dan mentor yang bersangkutan yang menerima notifikasi
        return [
            new PrivateChannel('chat.' . $this->userId . '.' . $this->mentorId),
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'message-sent';
    }
}