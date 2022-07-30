<?php

namespace DDD\Domain\Crawls\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CrawlResource extends JsonResource
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
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
