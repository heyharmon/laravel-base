<?php

namespace DDD\Http\Crawls;

use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Crawls\Crawl;

// Services
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;

// Resources
// use DDD\Domain\Crawls\Resources\CrawlResultResource;

// Jobs
// use DDD\Domain\Crawls\Jobs\monitorCrawlImportStatusJob;

class CrawlResultsImportController extends Controller
{
    public function import(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $results = $crawler->getResults($crawl->results_id);

        foreach ($results as $result) {
            $organization->pages()->updateOrCreate(
                ['url' => $result['url']],
                [
                    'http_status'   => $result['#debug']['statusCode'],
                    'title'         => $result['title'],
                    'url'           => $result['url'],
                    'wordcount'     => $result['wordcount'],
                    'redirected'    => $result['redirected'],
                    'requested_url' => $result['requestedUrl'],
                ]
            );
        }

        return response()->json([
            'message' => 'Crawl results imported.',
        ]);
    }
}
