<?php

namespace DDD\Domain\Base\Subscriptions\Plans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;

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
