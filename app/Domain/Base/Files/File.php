<?php

namespace DDD\Domain\Base\Files;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\BelongsToOrganization;

class File extends Model
{
    use BelongsToOrganization,
        BelongsToUser,
        HasFactory;

    protected $guarded = ['id'];

    public function getStorageUrl()
    {
        return config('cdn.cdn_url') . '/' . $this->path;
    }
}
