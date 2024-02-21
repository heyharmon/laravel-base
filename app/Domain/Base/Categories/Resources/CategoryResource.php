<?php

namespace DDD\Domain\Base\Categories\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
