<?php

namespace DDD\Domain\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// Domains
use DDD\Domain\Sites\Site;

// Traits
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\IsCategorizable;
use DDD\App\Traits\IsStatusable;
use DDD\App\Traits\IsTaggable;

class Page extends Model
{
    use HasFactory,
        SoftDeletes,
        BelongsToOrganization,
        BelongsToUser,
        IsCategorizable,
        IsStatusable,
        IsTaggable;

    protected $guarded = [
        'id',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
