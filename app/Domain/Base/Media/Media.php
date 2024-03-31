<?php

namespace DDD\Domain\Base\Media;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Illuminate\Support\Str;
use DDD\App\Traits\IsTaggable;
use DDD\App\Traits\BelongsToUser;

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
