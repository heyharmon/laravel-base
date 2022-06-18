<?php

namespace DDD\Domain\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

// Traits
use DDD\App\Traits\HasSlug;

class Tag extends Model
{
    use HasFactory,
        HasSlug,
        HasRecursiveRelationships;

    protected $guarded = [
        'id',
    ];
}
