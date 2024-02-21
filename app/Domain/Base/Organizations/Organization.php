<?php

namespace DDD\Domain\Base\Organizations;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasSlug;
// Domains
use DDD\Domain\Base\Subscriptions\Plans\Plan;
// Vendors
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

// Traits
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;

class Organization extends Model
{
    use Billable,
        HasComments,
        // InteractsWithMedia,
        HasFactory,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Users\User::class);
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Invitations\Invitation::class);
    }

    /**
     * Files associated with the organization.
     *
     * @return hasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Files\File::class);
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Teams\Team::class);
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Sites\Site::class);
    }

    /**
     * Plan organization is subscribed to.
     *
     * @return hasOneThrough
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

    // public function userCount()
    // {
    //     return $this->users->count();
    // }

    // public function canDowngradeToPlan(Plan $plan)
    // {
    //     return $this->userCount() <= $plan->limits['users'];
    // }
}
