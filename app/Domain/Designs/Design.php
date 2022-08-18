<?php

namespace DDD\Domain\Designs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Casts
use DDD\Domain\Designs\Casts\DesignVariables;

class Design extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'variables' => DesignVariables::class,
    ];
}
