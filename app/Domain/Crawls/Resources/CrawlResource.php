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
            'id' => $this->id,
            'url' => $this->url,
            'status' => $this->status,
            'total' => $this->total,
            'handled' => $this->handled,
            'pending' => $this->pending,
            'created_at' => $this->created_at,
        ];
    }
}
