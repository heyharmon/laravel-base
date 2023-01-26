<?php

namespace DDD\Domain\Redirects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;

class Redirect extends Model
{
    use HasFactory,
        SoftDeletes,
        BelongsToOrganization,
        BelongsToUser;

    protected $guarded = [
        'id',
    ];
}
