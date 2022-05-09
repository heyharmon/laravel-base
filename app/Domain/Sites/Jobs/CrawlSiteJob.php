<?php

namespace DDD\Domain\Sites\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Facades
use Illuminate\Support\Facades\Http;

// Services
use DDD\App\Services\UrlService;

// Domains
use DDD\Domain\Pages\Page;

class CrawlSiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * Public variables.
     */
    public $page;

    /**
     * Contructor
     *
     * @return void
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get page
        // $response = Http::get('http://localhost:5001/bloomcu-scraping-functions/us-central1/cheerio/page', [
        $response = Http::get('https://us-central1-bloomcu-scraping-functions.cloudfunctions.net/cheerio/page', [
            'url' => $this->page->url
        ])->json();

        // Fail job
        if ($response['status'] !== 200) {
            $this->page->update([
                'is_crawled' => true,
                'status'     => $response['status'],
            ]);

            return true;
        }

        // Update page
        $this->page->update([
            'is_crawled' => true,
            'status'     => $response['status'],
            'title'      => $response['title'],
            'wordcount'  => $response['wordcount'],
            // 'body'       => $response['body']
        ]);

        // Iterate over each link
        foreach ($response['links'] as $link) {
            // TODO: Do this in the crawler function
            $linkHost = UrlService::getHost($link['url']);

            // TODO: Right an action that processes the page via a pipeline:
            if (
                // TODO: Construct this page host
                // TODO: Better yet, inject the site model which has host on it
                $linkHost === UrlService::getHost($this->page->url) && // Host matches site
                !Page::where('url', $link['url'])->exists() // Doesn't already exist
            ) {
                $page = Page::create([
                    // TODO: If site model is injected, you can create this page from relationship
                    'site_id'    => $this->page->site_id,
                    'type'       => $link['type'],
                    'url'        => $link['url'],
                    'is_crawled' => false
                ]);

                // Crawl it
                if ($link['type'] === 'link') {
                    dispatch(new self($page));
                }
            }
        }
    }
}
