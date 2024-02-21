<?php

namespace DDD\Domain\Base\Categories;

use DDD\App\Traits\HasParents;
use DDD\App\Traits\HasSlug;
// Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,
        HasParents,
        HasSlug;

    protected $guarded = [
        'id',
    ];
}
