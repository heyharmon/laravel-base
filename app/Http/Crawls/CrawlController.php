<?php

namespace DDD\Http\Crawls;

use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Sites\Site;
use DDD\Domain\Crawls\Crawl;

// Services
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;

// Jobs
use DDD\Domain\Crawls\Jobs\monitorCrawlStatusJob;

class CrawlController extends Controller
{
    public function index(Organization $organization, Site $site)
    {
        $crawls = $site->crawls;

        return response()->json($crawls);
    }

    public function store(Organization $organization, Site $site, Crawler $crawler)
    {
        $service = $crawler->crawlSite($site->url);

        $crawl = $site->crawls()->create([
            'crawl_id' => $service['crawl_id'],
            'queue_id' => $service['queue_id'],
            'results_id' => $service['results_id'],
        ]);

        dispatch(new monitorCrawlStatusJob($crawl));

        return response()->json([
            'message' => 'Crawl in progress',
            'data' => $crawl,
        ]);
    }

    public function show(Organization $organization, Site $site, Crawl $crawl)
    {
        return response()->json($crawl);
    }

    public function destroy(Organization $organization, Site $site, Crawl $crawl, Crawler $crawler)
    {
        $crawler->abortCrawl($crawl->crawl_id);

        return response()->json([
            'message' => 'Crawl aborted.',
        ]);
    }
}
