<?php

namespace App\Events;

use App\Models\Mobile\MobileLead;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MobileLeadSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mobileLead;

    /**
     * Create a new event instance.
     *
     * @param MobileLead $mobileLead
     */
    public function __construct(MobileLead $mobileLead)
    {
        $this->mobileLead = $mobileLead;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
