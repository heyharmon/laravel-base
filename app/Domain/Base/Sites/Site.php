<?php

namespace DDD\Domain\Base\Sites;

use DDD\App\Traits\BelongsToOrganization;
use DDD\Domain\Base\Sites\Casts\LaunchInfo;
// Casts
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use BelongsToOrganization,
        // SoftDeletes,
        HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'launch_info' => LaunchInfo::class,
    ];
}
