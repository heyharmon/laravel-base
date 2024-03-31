<?php

namespace DDD\Http\Base\Subscriptions\Intent;

use DDD\Domain\Base\Subscriptions\Intent\Resources\IntentResource;
use DDD\Domain\Base\Organizations\Organization;
use DDD\App\Controllers\Controller;

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
