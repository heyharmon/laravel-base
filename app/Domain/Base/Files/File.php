<?php

namespace DDD\Domain\Base\Files;

use Illuminate\Database\Eloquent\Model;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;

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
