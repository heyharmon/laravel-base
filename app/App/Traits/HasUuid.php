<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function (Model $model) {
            if (! $model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }
}
