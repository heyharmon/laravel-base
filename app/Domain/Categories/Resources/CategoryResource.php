<?php

namespace DDD\Domain\Categories\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'categorized_count' => $this->tagged_count,
            'children_count' => $this->children()->count(),
            'children' => CategoryResource::collection($this->whenLoaded('children'))
        ];
    }
}
