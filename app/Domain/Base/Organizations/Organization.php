<?php

namespace DDD\Domain\Base\Organizations;

use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasSlug;
use DDD\Domain\Base\Subscriptions\Plans\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Domains
use Illuminate\Database\Eloquent\Model;
// Vendors
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
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
     * Sites associated with this organization.
     */
    public function sites(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Sites\Site::class);
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

    // public function userCount()
    // {
    //     return $this->users->count();
    // }

    // public function canDowngradeToPlan(Plan $plan)
    // {
    //     return $this->userCount() <= $plan->limits['users'];
    // }
}
