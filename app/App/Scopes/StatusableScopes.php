<?php

namespace DDD\App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait StatusableScopes
{
    public function scopeStatusNull(Builder $query): Builder
    {
        return $query->where('status_id', null);
    }
}
