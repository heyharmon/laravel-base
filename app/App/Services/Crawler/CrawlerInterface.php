<?php

namespace DDD\App\Services\Crawler;

interface CrawlerInterface
{
    public function crawlSite(string $url);
    public function getStatus(string $crawlId, string $queueId);
    public function getResults(string $resultsId);
    public function abortCrawl(string $crawlId);
}
