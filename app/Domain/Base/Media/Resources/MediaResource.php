<?php

namespace DDD\Domain\Base\Media\Resources;

use Illuminate\Http\Request;
use DDD\Domain\Base\Tags\Resources\TagResource;
// Resources
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'collection' => $this->collection_name,
            'name' => $this->name,
            'file_name' => $this->file_name,
            'size' => $this->size,
            'original_url' => $this->original_url,
            'extension' => $this->extension,
            'tags' => TagResource::collection($this->whenLoaded('tags'))->pluck('slug'),
        ];
    }
}
