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
use DDD\Domain\Crawls\Resources\CrawlResultResource;

class CrawlResultsController extends Controller
{
    public function show(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $results = $crawler->getResults($crawl->results_id);

        return CrawlResultResource::collection($results);
    }
}
