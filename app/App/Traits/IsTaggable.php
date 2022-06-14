<?php

namespace DDD\App\Traits;

use DDD\Domain\Tags\Tag;
use Illuminate\Database\Eloquent\Model;

trait IsTaggable
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
    }
}
