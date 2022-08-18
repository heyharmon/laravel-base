<?php

namespace DDD\Domain\Designs\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignResource extends JsonResource
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
            'designer' => $this->designer,
            'variables' => $this->variables,
            'created_at' => $this->created_at,
        ];
    }
}
