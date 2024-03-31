<?php

namespace DDD\Domain\Base\Subscriptions\Intent\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class IntentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'client_secret' => $this->client_secret,
        ];
    }
}
