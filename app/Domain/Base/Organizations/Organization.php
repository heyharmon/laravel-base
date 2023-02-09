<?php

namespace DDD\Domain\Base\Organizations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Domains
use DDD\Domain\Base\Subscriptions\Plans\Plan;

// Vendors
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

// Traits
use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasSlug;

class Organization extends Model implements HasMedia
{
    use HasFactory,
        Billable,
        InteractsWithMedia,
        HasComments,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany('DDD\Domain\Base\Users\User');
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations()
    {
        return $this->hasMany('DDD\Domain\Base\Invitations\Invitation');
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams()
    {
        return $this->hasMany('DDD\Domain\Base\Teams\Team');
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany('DDD\Domain\Base\Sites\Site');
    }

    /**
     * Plan organization is subscribed to.
     *
     * @return hasOneThrough
     */
    public function plan()
    {
        return $this->hasOneThrough(
            Plan::class, Subscription::class,
            'organization_id', 'stripe_price_id', 'id', 'stripe_price'
        )
            ->whereNull('subscriptions.ends_at') // Not being cancelled
            ->withDefault(Plan::free()->toArray());
    }

    // public function userCount()
    // {
    //     return $this->users->count();
    // }

    // public function canDowngradeToPlan(Plan $plan)
    // {
    //     return $this->userCount() <= $plan->limits['users'];
    // }
}
