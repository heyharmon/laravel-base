<?php

namespace DDD\App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CategorizableScopes
{
    public function scopeCategoryNull(Builder $query): Builder
    {
        return $query->where('category_id', null);
    }
}
