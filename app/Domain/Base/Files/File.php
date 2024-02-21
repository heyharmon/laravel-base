<?php

namespace DDD\Domain\Base\Files;

use DDD\App\Traits\BelongsToOrganization;
// use Illuminate\Support\Str;

// Vendors
// use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

// Traits
use DDD\App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use BelongsToOrganization,
        BelongsToUser;

    protected $guarded = ['id'];

    public function getStorageUrl()
    {
        return config('cdn.cdn_url').'/'.$this->path;
    }
}
