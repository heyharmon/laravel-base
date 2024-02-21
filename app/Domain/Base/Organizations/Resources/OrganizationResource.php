<?php

namespace DDD\Domain\Base\Organizations\Resources;

use DDD\Domain\Base\Subscriptions\Plans\Resources\PlanResource;
use Illuminate\Http\Request;
// Resources
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            // 'user_count' => $this->userCount(),
            'subscribed' => $this->subscribed('default'),
            'ends_at' => optional(optional($this->subscription('default'))->ends_at)->toDateTimeString(),
            'plan' => new PlanResource($this->plan),
        ];
    }
}
