<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public Chat $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('chat.' . $this->chat->recipient_id);
    }

    public function broadcastWith(): array
    {

        return [
            'id' => $this->chat->id,
            'sender_id' => $this->chat->sender_id,
            'recipient_id' => $this->chat->recipient_id,
            'message' => $this->chat->message,
            'sender_name' => $this->chat->sender->name,
            'sent_at' => $this->chat->sent_at,
            'sender_name' => $this->chat->sender->name,
            'chat' => $this->chat,
        ];
    }
}

