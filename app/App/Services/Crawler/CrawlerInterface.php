<?php

namespace DDD\App\Services\Crawler;

interface CrawlerInterface
{
    public function crawlSite(string $url);
    public function getStatus(string $status_id);
    public function getResults(string $results_id);
    public function abortCrawl(string $crawl_id);
}
