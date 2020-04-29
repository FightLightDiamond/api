<?php

namespace IO\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrivateMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('messages.' . $this->message->to);
//        return new PresenceChannel('messages.' . $this->message->to);
        // return new PrivateChannel('messages.' . $this->message->to);
    }

    public function broadcastAs()
    {
        return 'NewMessage';
    }

    public function broadcastWith()
    {
        $this->message->load('fromContact');
        return ['message' => $this->message];
    }
}
