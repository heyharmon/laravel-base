<?php

namespace DDD\Http\Base\Subscriptions\Checkout;

use Illuminate\Http\Request;
use DDD\Domain\Base\Subscriptions\Plans\Plan;
use DDD\Domain\Base\Organizations\Organization;
use DDD\App\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Complete subscription checkout
     */
    public function checkout(Organization $organization, Request $request)
    {
        $plan = Plan::whereSlug($request->plan)->first();

        $organization
            ->newSubscription('default', $plan->stripe_price_id)
            ->create($request->payment_method);
    }
}
