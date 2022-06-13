<?php

namespace DDD\Http\Sites;

use DDD\DDD\Controllers\Controller;
use DDD\DDD\Services\UrlService;
// Services
use DDD\Domain\Organizations\Organization;
// Jobs
use DDD\Domain\Sites\Jobs\CrawlSiteJob;
// Domains
use DDD\Domain\Sites\Site;
use Illuminate\Http\Request;

class SiteCrawlController extends Controller
{
    public function crawl(Organization $organization, Site $site)
    {
        $page = $site->pages()->firstOrCreate(
            ['url' => $site->start_url],
            [
                'is_crawled' => false,
                'url' => $site->start_url,
            ]
        );

        CrawlSiteJob::dispatch($site, $page);

        return response()->json([
            'message' => 'Crawl in progress',
            'page' => $page,
        ]);
    }
}
