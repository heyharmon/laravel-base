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
use DDD\App\Traits\HasParents;

class Design extends Model implements HasMedia
{
    use HasFactory,
        HasUuid,
        HasParents,
        InteractsWithMedia;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'variables' => DesignVariables::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $count = self::where('organization_id', $model->organization_id)->count();

            $model->title = 'Style #' . $count + 1;
        });
    }

}
