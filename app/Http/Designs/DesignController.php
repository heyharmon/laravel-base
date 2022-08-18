<?php

namespace DDD\Http\Designs;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Designs\Design;

// Requests
use DDD\Domain\Designs\Requests\DesignStoreRequest;
use DDD\Domain\Designs\Requests\DesignUpdateRequest;

// Resources
use DDD\Domain\Designs\Resources\DesignResource;

class DesignController extends Controller
{
    public function index(Organization $organization)
    {
        $designs = $organization->designs()->latest()->get();

        return DesignResource::collection($designs);
    }

    public function store(Organization $organization, DesignStoreRequest $request)
    {
        $design = $organization->designs()->create(
            $request->validated()
        );

        return new DesignResource($design);
    }

    public function show(Organization $organization, Design $design)
    {
        return new DesignResource($design);
    }

    public function update(Organization $organization, Design $design, DesignUpdateRequest $request)
    {
        $design->update($request->validated());

        return new DesignResource($design);
    }

    public function destroy(Organization $organization, Design $design)
    {
        $design->delete();

        return new DesignResource($design);
    }
}
