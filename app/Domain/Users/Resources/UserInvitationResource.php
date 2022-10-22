<?php

namespace DDD\Domain\Users\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInvitationResource extends JsonResource
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
            'email' => $this->email,
            'role' => $this->role,
            'url' => $this->url(),
            'created_at' => $this->created_at,
        ];
    }
}
