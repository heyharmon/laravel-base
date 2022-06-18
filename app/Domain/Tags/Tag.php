<?php

namespace DDD\Domain\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

// Traits
use DDD\App\Traits\HasSlug;

class Tag extends Model
{
    use HasFactory,
        HasSlug,
        HasRecursiveRelationships;

    protected $guarded = [
        'id',
    ];

    /**
     * Get the children tags associated with this tag.
     *
     * @return hasMany
     */
    public function children()
    {
        return $this->hasMany(Tag::class, 'parent_id');
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
