<?php

namespace DDD\Domain\Files;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\BelongsToOrganization;

class File extends Model
{
    use HasFactory,
        BelongsToOrganization;

    protected $guarded = [
        'id',
    ];
}
