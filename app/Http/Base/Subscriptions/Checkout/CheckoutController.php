<?php

namespace DDD\Http\Base\Subscriptions\Checkout;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Subscriptions\Plans\Plan;

// Requests
use DDD\Domain\Base\Subscriptions\Subscriptions\Requests\SubscriptionStoreRequest;
use DDD\Domain\Base\Subscriptions\Subscriptions\Requests\SubscriptionUpdateRequest;

// Resources
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;

class CheckoutController extends Controller
{
    /**
     * Complete subscription checkout
     */
    public function checkout(Organization $organization)
    {
        // $plan = Plan::whereSlug($request->plan)->first();

        // $organization
        //     ->newSubscription('default', $plan->stripe_price_id)
        //     ->create($request->payment_method);
    }
}
