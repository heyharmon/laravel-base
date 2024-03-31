<?php

namespace DDD\Http\Base\Subscriptions\Plans;

use DDD\Domain\Base\Subscriptions\Plans\Plan;
use DDD\Domain\Base\Organizations\Organization;
use DDD\App\Controllers\Controller;

class PlanSwapAvailabilityController extends Controller
{
    /**
     * Determine which plans an organization can swap to.
     */
    public function __invoke(Organization $organization)
    {
        $activePlan = $organization->plan->slug;
        $userCount = $organization->users->count();

        return [
            'data' => Plan::get()->flatMap(function ($plan) use ($activePlan, $userCount) {
                return [
                    $plan->slug => (
                        $activePlan != $plan->slug &&
                        $userCount <= $plan->limits['users']
                    ),
                ];
            }),
        ];
    }
}
