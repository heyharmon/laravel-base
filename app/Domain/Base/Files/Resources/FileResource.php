<?php

namespace DDD\Domain\Base\Files\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
