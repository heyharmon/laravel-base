<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

trait HasParents
{
    use HasRecursiveRelationships;

    /**
     * Get the nested children associated with this model.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Get only parents (top level models).
     */
    public function scopeParents(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }
}
