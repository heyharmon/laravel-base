<?php

namespace DDD\Domain\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\IsNestable;

class Tag extends Model
{
    use HasFactory,
        HasSlug,
        IsNestable;

    protected $guarded = [
        'id',
    ];
}
