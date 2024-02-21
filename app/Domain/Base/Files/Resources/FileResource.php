<?php

namespace DDD\Domain\Base\Files\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Resources

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'filename' => $this->filename,
            'path' => $this->path,
            'url' => $this->getStorageUrl(),
            'extension' => $this->extension,
            'mime' => $this->mime,
        ];
    }
}
