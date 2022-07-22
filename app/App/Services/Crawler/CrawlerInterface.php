<?php

namespace DDD\App\Services\Crawler;

interface CrawlerInterface
{
    public function crawlSite(string $url);
    public function getStatus(string $id);
    public function getResults(string $id);
}
