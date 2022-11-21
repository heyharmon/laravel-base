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
            $response = Http::post('https://api.apify.com/v2/actor-tasks/' . $this->cheerioActor . '/runs?token=' . $this->token, [
                'startUrls' => [['url' => $url . '/']],
                'pseudoUrls' => [['purl' => $url . '/[.*?]']]
            ])->json();

            return [
                'crawl_id'   => $response['data']['id'],
                'queue_id'   => $response['data']['defaultRequestQueueId'],
                'results_id' => $response['data']['defaultDatasetId'],
            ];
        } catch (RequestException $exception) {
            abort(500, 'Could not start Apify crawler.');
        }
    }

    public function getStatus(string $crawlId, string $queueId)
    {
        try {
            $run = Http::get('https://api.apify.com/v2/actor-runs/' . $crawlId . '?token=' . $this->token)->json();
            $queue = Http::get('https://api.apify.com/v2/request-queues/' . $queueId . '?token=' . $this->token)->json();

            return [
                'status'  => $run['data']['status'],
                'total'   => $queue['data']['totalRequestCount'],
                'handled' => $queue['data']['handledRequestCount'],
                'pending' => $queue['data']['pendingRequestCount'],
            ];
        } catch (RequestException $exception) {
            abort(500, 'Could not retrieve status from Apify crawler.');
        }
    }

    public function getResults(string $datasetId)
    {
        try {
            $request = Http::get('https://api.apify.com/v2/datasets/' . $datasetId . '/items?token=' . $this->token)->json();
            return $request;
        } catch (RequestException $exception) {
            abort(500, 'Could not get Apify crawl results.');
        }
    }

    public function abortCrawl(string $crawlId)
    {
        try {
            $request = Http::post('https://api.apify.com/v2/actor-runs/' . $crawlId . '/abort?token=' . $this->token)->json();
            return $request;
        } catch (RequestException $exception) {
            abort(500, 'Could not abort Apify crawler.');
        }
    }
}
