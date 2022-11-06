<?php

namespace DDD\Domain\Statuses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\HasParents;

class Status extends Model
{
    use HasFactory,
        HasSlug,
        HasParents;

    protected $guarded = [
        'id',
    ];
}
