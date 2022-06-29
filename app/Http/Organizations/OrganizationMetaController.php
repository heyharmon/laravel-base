<?php

namespace DDD\Http\Organizations;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Meta\Meta;

class OrganizationMetaController extends Controller
{
    /**
     * List all organization metadata
     */
    public function index(Organization $organization)
    {
        // TODO: Use an API Resource to return this
        return response()->json($organization->metas()->latest()->get());
    }

    /**
     * Store a metadata item for organization
     */
    public function store(Organization $organization, Request $request)
    {
        // dd(gettype($request->value));
        // dd($request->value);

        $organization->saveMetadata($request->key, $request->value);

        // TODO: Use an API Resource to return this
        return response()->json(
            $organization->getMetadata($request->key)
        );
    }

    /**
     * Show an organization metadata item.
     */
    public function show(Organization $organization, Meta $meta)
    {
        // TODO: Use an API Resource to return this
        return response()->json($meta);
    }
}
