<?php

namespace DDD\Http\Crawls;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Crawls\Crawl;

// Services
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;

// Jobs
use DDD\Domain\Crawls\Jobs\CheckCrawlStatusJob;

// Requests
use DDD\Domain\Crawls\Requests\CrawlStoreRequest;

// Resources
use DDD\Domain\Crawls\Resources\CrawlResource;

class CrawlController extends Controller
{
    public function index(Organization $organization)
    {
        $crawls = $organization->crawls()->latest()->get();

        return CrawlResource::collection($crawls);
    }

    public function store(Organization $organization, CrawlStoreRequest $request, Crawler $crawler)
    {
        $service = $crawler->crawlSite($request->url);

        $crawl = $organization->crawls()->create([
            'url'        => $request->url,
            'crawl_id'   => $service['crawl_id'],
            'queue_id'   => $service['queue_id'],
            'results_id' => $service['results_id'],
        ]);

        dispatch(new CheckCrawlStatusJob($crawl));

        return response()->json([
            'message' => 'Crawl in progress',
            'data' => new CrawlResource($crawl),
        ]);
    }

    public function show(Organization $organization, Crawl $crawl)
    {
        return new CrawlResource($crawl);
    }

    public function destroy(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $crawler->abortCrawl($crawl->crawl_id);

        return response()->json([
            'message' => 'Crawl aborted.',
        ]);
    }
}
