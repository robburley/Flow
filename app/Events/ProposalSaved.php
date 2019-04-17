<?php

namespace App\Events;

use App\Models\Mobile\Proposals\Proposal;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProposalSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $proposal;

    /**
     * Create a new event instance.
     *
     * @param Proposal $proposal
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
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
