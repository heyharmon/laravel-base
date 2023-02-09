<?php

namespace DDD\Domain\Base\Subscriptions\Intent\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IntentResource extends JsonResource
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
            'client_secret' => $this->client_secret,
        ];
    }
}
