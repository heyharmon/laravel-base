<?php

namespace DDD\App\Traits;

// Vendors
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

trait HasParents
{
    use HasRecursiveRelationships;

    /**
     * Get the nested children associated with this model.
     *
     * @return hasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Get only parents (top level models).
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
