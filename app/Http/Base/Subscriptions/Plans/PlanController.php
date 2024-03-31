<?php

namespace DDD\Http\Base\Subscriptions\Plans;

use DDD\Domain\Base\Subscriptions\Plans\Resources\PlanResource;
use DDD\Domain\Base\Subscriptions\Plans\Plan;
use DDD\App\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * List plans.
     */
    public function index()
    {
        $plans = Plan::latest()->get();

        return PlanResource::collection($plans);
    }
}
