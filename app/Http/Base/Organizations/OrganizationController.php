<?php

namespace DDD\Http\Base\Organizations;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Organizations\Organization;

// Resources
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::latest()->get();

        return OrganizationResource::collection($organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organization = Organization::create($request->all());

        return new OrganizationResource($organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        return new OrganizationResource($organization);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Organization $organization, Request $request)
    {
        $organization->update($request->all());

        return new OrganizationResource($organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return new OrganizationResource($organization);
    }
}
