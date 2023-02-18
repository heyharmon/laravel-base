<?php

namespace DDD\Domain\Base\Categories\Resources;

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
            // 'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'children' => CategoryResource::collection($this->whenLoaded('children'))
        ];
    }
}
