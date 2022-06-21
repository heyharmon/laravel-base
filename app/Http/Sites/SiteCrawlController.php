<?php

namespace DDD\Http\Sites;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Sites\Site;

// Services
use DDD\App\Services\UrlService;

// Jobs
use DDD\Domain\Pages\Jobs\CrawlPageJob;


class SiteCrawlController extends Controller
{
    public function crawl(Organization $organization, Site $site)
    {
        $page = $site->pages()->firstOrCreate(
            ['url' => $site->start_url],
            [
                'url'        => $site->start_url,
                'is_crawled' => false,
            ]
        );

        // CrawlPageJob::dispatch($site, $page);

        Bus::batch(
            new CrawlPageJob($site, $page)
        )->dispatch();

        return response()->json([
            'message' => 'Crawl in progress',
            'page' => $page,
        ]);
    }
}
