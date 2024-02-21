<?php

namespace DDD\App\Traits;

// Models
use Illuminate\Database\Eloquent\Relations\MorphMany;
use DDD\Domain\Base\Comments\Comment;

trait HasComments
{
    /**
     * Get comments using polymorphic relationship
     *
     * @return mixed
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id')
            ->latest();
    }
}
