<?php

namespace DDD\Http\Base\Subscriptions\Subscriptions;

use DDD\Domain\Base\Subscriptions\Subscriptions\Requests\SubscriptionUpdateRequest;
use DDD\Domain\Base\Subscriptions\Subscriptions\Requests\SubscriptionStoreRequest;
use DDD\Domain\Base\Subscriptions\Plans\Plan;
use DDD\Domain\Base\Organizations\Organization;
use DDD\App\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * Store a subscription.
     */
    public function store(Organization $organization, SubscriptionStoreRequest $request)
    {
        $plan = Plan::whereSlug($request->plan)
            ->orWhere('slug', 'free-plan')
            ->first();

        $organization
            ->newSubscription('default', $plan->stripe_price_id)
            ->create($request->payment_method);
    }

    /**
     * Update a subscription.
     */
    public function update(Organization $organization, SubscriptionUpdateRequest $request)
    {
        $plan = Plan::whereSlug($request->plan)->first();

        if ($plan->buyable) {
            $organization->subscription('default')->swap($plan->stripe_price_id);
        } else {
            $organization->subscription('default')->cancel();
        }
    }
}
