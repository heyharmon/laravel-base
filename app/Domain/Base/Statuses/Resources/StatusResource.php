<?php

namespace DDD\Domain\Base\Statuses\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'children' => StatusResource::collection($this->whenLoaded('children')),
        ];
    }
}
