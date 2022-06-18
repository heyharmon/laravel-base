<?php

namespace DDD\Http\Tags\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'tagged_count' => $this->tagged_count,
            'children_count' => $this->children()->count(),
            'children' => TagResource::collection($this->whenLoaded('children'))
        ];
    }
}
