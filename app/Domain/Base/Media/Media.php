<?php

namespace DDD\Domain\Base\Media;

use Illuminate\Support\Str;

// Vendors
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

// Traits
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\IsTaggable;

class Media extends BaseMedia
{
    use BelongsToUser,
        IsTaggable;

    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $name = Str::replace(' ', '-', $model->name);
            $model->name = $name;
        });
    }
}
