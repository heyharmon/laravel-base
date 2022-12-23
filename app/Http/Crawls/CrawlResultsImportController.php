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
use DDD\App\Services\UrlService;

class CrawlResultsImportController extends Controller
{
    public function import(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $results = $crawler->getResults($crawl->results_id);

        foreach ($results as $result) {
            $cleanDestinationUrl = UrlService::getClean($result['destination_url']);

            $organization->pages()->updateOrCreate(
                ['url' => $cleanDestinationUrl],
                [
                    'http_status'   => $result['http_status'],
                    'title'         => $result['title'],
                    'wordcount'     => $result['wordcount'],
                    'url'           => $cleanDestinationUrl,
                ]
            );
        }

        return response()->json([
            'message' => 'Crawl results imported.',
        ]);
    }
}
