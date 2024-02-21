<?php

namespace DDD\Domain\Base\Media;

use DDD\App\Traits\BelongsToUser;
// Vendors
use DDD\App\Traits\IsTaggable;
// Traits
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use BelongsToUser,
        IsTaggable;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $name = Str::replace(' ', '-', $model->name);
            $model->name = $name;
        });
    }
}
