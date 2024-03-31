<?php

namespace DDD\Domain\Base\Categories\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
