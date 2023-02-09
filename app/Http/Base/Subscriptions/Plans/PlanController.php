<?php

namespace DDD\Http\Base\Subscriptions\Plans;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Subscriptions\Plans\Plan;

// Resources
use DDD\Domain\Base\Subscriptions\Plans\Resources\PlanResource;

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
