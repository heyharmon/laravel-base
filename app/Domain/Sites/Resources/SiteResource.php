<?php

namespace DDD\Domain\Sites\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Crawls\Resources\CrawlResource;

class SiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'title' => $this->title,
            'url' => $this->url,
            'host' => $this->host,
            'scheme' => $this->scheme,
            'last_crawl' => new CrawlResource($this->lastCrawl),
            'launch_info' => $this->launch_info,
        ];
    }
}
