<?php

namespace DDD\App\Traits;

// Vendors
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

trait IsNestable
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
     * Get only parent (top level) tags.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
