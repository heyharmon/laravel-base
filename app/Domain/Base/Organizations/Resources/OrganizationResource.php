<?php

namespace DDD\Domain\Base\Organizations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use DDD\Domain\Base\Subscriptions\Plans\Resources\PlanResource;

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
            'automating' => $this->automating,
            'automation_msg' => $this->automation_msg,
            'subscribed' => $this->subscribed('default'),
            'ends_at' => optional(optional($this->subscription('default'))->ends_at)->toDateTimeString(),
            'plan' => new PlanResource($this->plan),
        ];
    }
}
