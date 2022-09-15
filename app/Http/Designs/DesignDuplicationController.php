<?php

namespace DDD\Http\Designs;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Designs\Design;

// Requests
use DDD\Domain\Designs\Requests\DesignStoreRequest;

// Resources
use DDD\Domain\Designs\Resources\DesignResource;

class DesignDuplicationController extends Controller
{
    public function duplicate(Organization $organization, Design $design, DesignStoreRequest $request)
    {
        $newDesign = $design->replicate();

        $newDesign->uuid = Str::uuid();
        $newDesign->parent_id = $design->id;
        $newDesign->designer_name = $request->designer_name;
        $newDesign->designer_email = $request->designer_email;

        $newDesign->save();

        return new DesignResource($newDesign);
    }
}
