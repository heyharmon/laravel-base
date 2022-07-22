<?php

namespace DDD\Http\Sites\Crawls;

use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Sites\Site;
use DDD\Domain\Sites\Crawls\Crawl;

// Services
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;


class CrawlController extends Controller
{
    public function index(Organization $organization, Site $site)
    {
        $crawls = $site->crawls;

        return response()->json($crawls);
    }

    public function store(Organization $organization, Site $site, Crawler $crawler)
    {
        $response = $crawler->crawlSite($site->start_url);

        $crawl = $site->crawls()->create($response);

        return response()->json([
            'message' => 'Crawl in progress',
            'data' => $crawl,
        ]);
    }

    public function show(Organization $organization, Site $site, Crawl $crawl, Crawler $crawler)
    {
        $status = $crawler->getStatus($crawl->status_id);

        if ($status['pendingRequestCount'] === 0) {
            $results = $crawler->getResults($crawl->results_id);
        }

        return response()->json([
            'status' => $status,
            'data' => $results ?? [],
        ]);
    }
}
