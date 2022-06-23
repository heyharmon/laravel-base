<?php

namespace DDD\Http\Organizations;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Organizations\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::latest()->get();

        // TODO: Use an API Resource to return this
        return response()->json($organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organization = Organization::create([
            'title' => $request['title'],
        ]);

        // TODO: Use an API Resource to return this
        return response()->json($organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        // TODO: Use an API Resource to return this
        return response()->json($organization);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Organization $organization, Request $request)
    {
        $organization->update([
            'title' => $request['title'],
        ]);

        // TODO: Use an API Resource to return this
        return response()->json($organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        // TODO: Use an API Resource to return this
        return response()->json($organization);
    }
}
