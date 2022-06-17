<?php

namespace DDD\Domain\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Domains
use DDD\Domain\Tags\Tag;

// Traits
use DDD\App\Traits\HasSlug;

class TagGroup extends Model
{
    use HasFactory,
        HasSlug;

    protected $guarded = [
        'id',
    ];

    /**
     * Get the tags associated with this group.
     *
     * @return hasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
