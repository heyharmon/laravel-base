<?php

namespace DDD\Domain\Redirects\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RedirectResource extends JsonResource
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
            'requested_url' => $this->requested_url,
            'destination_url' => $this->destination_url,
            'group' => $this->group,
            'created_at' => $this->created_at,
        ];
    }
}
