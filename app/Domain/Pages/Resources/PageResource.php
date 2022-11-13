<?php

namespace DDD\Domain\Pages\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Statuses\Resources\StatusResource;
use DDD\Domain\Categories\Resources\CategoryResource;
use DDD\Domain\Users\Resources\UserResource;

class PageResource extends JsonResource
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
            'http_status' => $this->http_status,
            'title' => $this->title,
            'url' => $this->url,
            'wordcount' => $this->wordcount,
            'user' => new UserResource($this->whenLoaded('user')),
            'status' => new StatusResource($this->whenLoaded('status')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            // 'status' => $this->whenLoaded('status', fn() => $this->status->slug),
            // 'category' => $this->whenLoaded('category', fn() => $this->category->slug),
            'created_at' => $this->created_at,
        ];
    }
}
