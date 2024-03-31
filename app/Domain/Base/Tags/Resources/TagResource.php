<?php

namespace DDD\Domain\Base\Tags\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'tagged_count' => $this->tagged_count,
            'children_count' => $this->children()->count(),
            'children' => TagResource::collection($this->whenLoaded('children')),
        ];
    }
}
