<?php

namespace DDD\Http\Base\Billing\Plans;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Billing\Plans\Plan;

// Resources
use DDD\Domain\Base\Billing\Plans\Resources\PlanResource;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::latest()->get();

        return PlanResource::collection($plans);
    }
}
