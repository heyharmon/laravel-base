<?php

namespace DDD\Domain\Base\Subscriptions\Plans;

use DDD\App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory,
        HasSlug;

    protected $table = 'subscription_plans';

    protected $guarded = ['id'];

    protected $casts = [
        'limits' => 'json',
    ];

    public static function free()
    {
        return static::where('buyable', false)->first();
    }
}
