<?php

namespace DDD\Domain\Base\Subscriptions\Plans\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
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
