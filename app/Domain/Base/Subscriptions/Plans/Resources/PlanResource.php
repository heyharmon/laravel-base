<?php

namespace DDD\Domain\Base\Subscriptions\Plans\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => '$'.number_format($this->price / 100),
            'interval' => $this->interval,
            'limits' => $this->limits,
        ];
    }
}
