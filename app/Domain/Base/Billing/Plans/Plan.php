<?php

namespace DDD\Domain\Base\Billing\Plans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Traits
use DDD\App\Traits\HasSlug;

class Plan extends Model
{
    use HasFactory,
        HasSlug;

    protected $table = 'billing_plans';

    protected $guarded = ['id'];

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Base\Users\User');
    }
}
