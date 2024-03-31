<?php

namespace DDD\Domain\Base\Invitations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use DDD\Domain\Base\Users\Resources\UserResource;
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;

class InvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
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
