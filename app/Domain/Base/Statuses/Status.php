<?php

namespace DDD\Domain\Base\Statuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\HasParents;

class Status extends Model
{
    use HasFactory,
        HasParents,
        HasSlug;

    protected $guarded = [
        'id',
    ];
}
