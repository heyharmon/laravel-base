<?php

namespace DDD\Domain\Base\Comments\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Base\Users\Resources\UserResource;

class CommentResource extends JsonResource
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
            'body' => $this->body,
            'group' => $this->group,
            'user' => new UserResource($this->user),
            'children' => CommentResource::collection($this->whenLoaded('children'))
        ];
    }
}
