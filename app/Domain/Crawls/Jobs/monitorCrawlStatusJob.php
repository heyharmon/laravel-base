<?php

namespace DDD\Domain\Crawls\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Domains
use DDD\Domain\Crawls\Crawl;

// Events
use DDD\Domain\Crawls\Events\CrawlStatusUpdatedEvent;

// Services
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;

class MonitorCrawlStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Batchable, Queueable, SerializesModels;

    public $crawl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Crawl $crawl)
    {
        $this->crawl = $crawl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Crawler $crawler)
    {
        $crawl = $crawler->getStatus(
            $this->crawl->crawl_id,
            $this->crawl->queue_id
        );

        $this->crawl->update($crawl);

        CrawlStatusUpdatedEvent::dispatch($this->crawl);

        $monitoredStatuses = [
            'READY',
            'RUNNING',
            'TIMING-OUT',
            'ABORTING',
        ];

        if (in_array($crawl['status'], $monitoredStatuses)) {
            dispatch(new self($this->crawl))->delay(5);
        }
    }
}
