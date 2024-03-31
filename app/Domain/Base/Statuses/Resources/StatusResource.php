<?php

namespace DDD\Domain\Base\Statuses\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'children' => StatusResource::collection($this->whenLoaded('children')),
        ];
    }
}
