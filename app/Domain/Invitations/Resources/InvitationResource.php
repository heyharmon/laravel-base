<?php

namespace DDD\Domain\Invitations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Resources
use DDD\Domain\Organizations\Resources\OrganizationResource;
use DDD\Domain\Users\Resources\UserResource;

class InvitationResource extends JsonResource
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
            'uuid' => $this->uuid,
            'email' => $this->email,
            'role' => $this->role,
            'url' => $this->url(),
            'organization' => new OrganizationResource($this->whenLoaded('organization')),
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
        ];
    }
}
