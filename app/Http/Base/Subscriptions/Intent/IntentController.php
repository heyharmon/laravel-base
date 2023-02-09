<?php

namespace DDD\Http\Base\Subscriptions\Intent;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Base\Organizations\Organization;

// Resources
use DDD\Domain\Base\Subscriptions\Intent\Resources\IntentResource;

class IntentController extends Controller
{
    /**
     * Create a payment intent token.
     */
    public function __invoke(Organization $organization)
    {
        return new IntentResource(
            $organization->createSetupIntent()
        );
    }
}
