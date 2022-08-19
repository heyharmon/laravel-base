<?php

namespace DDD\Domain\Media;

// Vendors
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

// Traits
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\IsTaggable;

class Media extends BaseMedia
{
    use BelongsToUser,
        IsTaggable;
}
