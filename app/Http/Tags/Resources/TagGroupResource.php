<?php

namespace DDD\Http\Tags\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Http\Tags\Resources\TagResource;

class TagGroupResource extends JsonResource
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
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
