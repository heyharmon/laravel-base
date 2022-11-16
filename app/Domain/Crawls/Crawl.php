<?php

namespace DDD\Domain\Crawls;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\BelongsToOrganization;

class Crawl extends Model
{
    use HasFactory,
        BelongsToOrganization;

    protected $guarded = [
        'id',
    ];
}
