<?php

namespace DDD\Domain\Designs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Vendors
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// Casts
use DDD\Domain\Designs\Casts\DesignVariables;

// Traits
use DDD\App\Traits\HasUuid;

class Design extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasUuid;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'variables' => DesignVariables::class,
    ];
}
