<?php

namespace DDD\Domain\Base\Organizations;

use Laravel\Cashier\Subscription;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DDD\Domain\Base\Subscriptions\Plans\Plan;
use DDD\App\Traits\HasSlug;
use DDD\App\Traits\HasComments;

class Organization extends Model
{
    use Billable,
        HasComments,
        HasFactory,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Users associated with the organization.
     */
    public function users(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Users\User::class);
    }

    /**
     * Invitations associated with the organization.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Invitations\Invitation::class);
    }

    /**
     * Files associated with the organization.
     */
    public function files(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Files\File::class);
    }

    /**
     * Teams that belong to this team.
     */
    public function teams(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Teams\Team::class);
    }

    /**
     * Plan organization is subscribed to.
     */
    public function plan(): HasOneThrough
    {
        return $this->hasOneThrough(
            Plan::class, Subscription::class,
            'organization_id', 'stripe_price_id', 'id', 'stripe_price'
        )
            ->whereNull('subscriptions.ends_at') // Not being cancelled
            ->withDefault(Plan::free()->toArray());
    }
}
