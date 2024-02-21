<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToOrganization
{
    /**
     * Scope a query to only include users in an organization.
     */
    public function scopeOrganization(Builder $query, $organization_id): void
    {
        $query->where('organization_id', $organization_id);
    }

    // protected static function bootBelongsToOrganization(): void
    // {
    //     static::creating(function (Model $model) {
    //         dd(request());
    //         if ($user = request()->user()) {
    //             $model->user_id = request()->user()->id;
    //         }
    //     });
    // }

    /**
     * Organization this model belongs to.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(\DDD\Domain\Base\Organizations\Organization::class);
    }
}
