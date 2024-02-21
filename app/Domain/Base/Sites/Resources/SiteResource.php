<?php

namespace DDD\Domain\Base\Sites\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
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
            'organization_id' => $this->organization_id,
            'title' => $this->title,
            'url' => $this->url,
            'domain' => $this->domain,
            'scheme' => $this->scheme,
            'launch_info' => $this->launch_info,
        ];
    }
}
