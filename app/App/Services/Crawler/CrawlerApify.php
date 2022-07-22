<?php

namespace DDD\App\Services\Crawler;

use Illuminate\Support\Facades\Http;

use DDD\App\Services\Crawler\CrawlerInterface;

class CrawlerApify implements CrawlerInterface
{
    public function __construct(
        protected string $token,
        protected string $cheerioActor,
        protected string $puppeteerActor,
    ) {}

    public function crawlSite(string $url)
    {
        try {
            $request = Http::post('https://api.apify.com/v2/actor-tasks/' . $this->cheerioActor . '/runs?token=' . $this->token, [
                'startUrls' => [
                    ['url' => $url]
                ],
                'pseudoUrls' => [
                    ['purl' => $url . '/[.*?]']
                ]
            ]);

            $response = $request->json();

            return [
                'crawl_id' => $response['data']['id'],
                'status_id' => $response['data']['defaultRequestQueueId'],
                'results_id' => $response['data']['defaultDatasetId'],
            ];
        } catch (RequestException $exception) {
            abort(500, 'Crawler service could not start crawl.');
        }
    }

    public function getStatus(string $queueId)
    {
        try {
            $request = Http::get('https://api.apify.com/v2/request-queues/' . $queueId . '?token=' . $this->token);
            $response = $request->json();
            return $response['data'];
        } catch (RequestException $exception) {
            abort(500, 'Crawler service could not get crawl status.');
        }
    }

    public function getResults(string $datasetId)
    {
        try {
            $request = Http::get('https://api.apify.com/v2/datasets/' . $datasetId . '/items?token=' . $this->token);
            return $request->json();
        } catch (RequestException $exception) {
            abort(500, 'Crawler service could not get crawl results.');
        }
    }

    public function abortCrawl(string $crawlId)
    {
        try {
            $request = Http::post('https://api.apify.com/v2/actor-runs/' . $crawlId . '/abort?token=' . $this->token);
            return $request->json();
        } catch (RequestException $exception) {
            abort(500, 'Crawler service could not abort crawl.');
        }
    }
}
