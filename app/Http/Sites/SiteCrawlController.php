<?php

namespace DDD\Http\Sites;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Services
use DDD\App\Services\UrlService;

// Jobs
use DDD\Domain\Sites\Jobs\CrawlSiteJob;

// Domains
use DDD\Domain\Sites\Site;

class SiteCrawlController extends Controller
{
    public function crawl(Site $site)
    {
        $page = $site->pages()->firstOrCreate(
            ['url' => $site->start_url],
            [
                'is_crawled' => false,
                'url' => $site->start_url,
            ]
        );

        CrawlSiteJob::dispatch($page);

        return response()->json([
            'message' => 'Crawl in progress',
            'page' => $page
        ]);
    }
}
