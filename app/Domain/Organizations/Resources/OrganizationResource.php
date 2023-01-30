<?php

namespace DDD\Domain\Organizations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Meta\Resources\MetaResource;
// use DDD\Domain\Crawls\Resources\CrawlResource;

class OrganizationResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'meta' => MetaResource::collection($this->whenLoaded('meta')),
        ];
    }
}
