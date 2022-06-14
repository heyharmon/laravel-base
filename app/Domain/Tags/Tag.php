<?php

namespace DDD\Domain\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;

class Tag extends Model
{
    use HasFactory,
        HasSlug;

    protected $guarded = [
        'id',
    ];
}
