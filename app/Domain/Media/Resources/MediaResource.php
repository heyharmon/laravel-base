<?php

namespace DDD\Domain\Media\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Tags\Resources\TagResource;

class MediaResource extends JsonResource
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
            'collection' => $this->collection_name,
            'name' => $this->name,
            'original_url' => $this->original_url,
            'extension' => $this->extension,
            'size' => $this->size,
            'tags' => TagResource::collection($this->whenLoaded('tags'))->pluck('slug')
        ];
    }
}
