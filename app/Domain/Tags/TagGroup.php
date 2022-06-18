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

    /**
     * Get the tags as recursive tree
     *
     * @return Collection
     */
    public function tagTree()
    {
        return Tag::where('tag_group_id', $this->id)->tree()->get()->toTree();
    }

    // public function tagTree()
    // {
    //     $tags = $this->tags();
    //
    //     $grouped = $tags->get()->groupBy('parent_id');
    //
    //     $roots = $grouped->get(null);
    //
    //     return $this->buildTagTree($roots, $grouped);
    // }
    //
    // protected function buildTagTree($roots, $grouped)
    // {
    //     return $roots->each(function ($root) use ($grouped) {
    //         if ($children = $grouped->get($root->id)) {
    //             $root->children = $children;
    //             $this->buildTagTree($root->children, $grouped);
    //         }
    //     });
    // }
}
