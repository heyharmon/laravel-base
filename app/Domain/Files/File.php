<?php

namespace DDD\Domain\Files;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Image\Manipulations;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;

// Traits
use DDD\App\Traits\BelongsToOrganization;

class File extends Model implements HasMedia
{
    use HasFactory,
        // InteractsWithMedia,
        BelongsToOrganization;

    protected $guarded = [
        'id',
    ];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //         ->fit(Manipulations::FIT_CROP, 300, 300)
    //         ->nonQueued();
    // }
}
