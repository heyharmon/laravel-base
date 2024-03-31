<?php

namespace DDD\Domain\Base\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\HasParents;

class Category extends Model
{
    use HasFactory,
        HasParents,
        HasSlug;

    protected $guarded = [
        'id',
    ];
}
