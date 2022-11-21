<?php

namespace DDD\Domain\Crawls\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CrawlResultResource extends JsonResource
{
    // protected $results = [];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'http_status' => $this['#debug']['statusCode'],
            'title' => $this['title'],
            'url' => $this['url'],
            'wordcount' => $this['wordcount'],
            'redirected' => $this['redirected'],
            'requested_url' => $this['requestedUrl'],
        ];
    }
}
