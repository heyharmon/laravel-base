<?php

namespace DDD\Domain\Crawls\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Domains
use DDD\Domain\Crawls\Crawl;

class CrawlStatusUpdatedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Crawl $crawl)
    {
        //
    }

    /**
     * Overwrite the event name.
     *
     * @return String Event name
     */
    public function broadcastAs()
    {
        return 'CrawlStatusUpdated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('DDD.Domain.Crawls.Crawl.' . $this->crawl->id);
    }
}
