<?php

namespace DDD\Http\Redirects;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Redirects\Redirect;

// Requests
use DDD\Domain\Redirects\Requests\RedirectStoreRequest;
use DDD\Domain\Redirects\Requests\RedirectUpdateRequest;

// Resources
use DDD\Domain\Redirects\Resources\RedirectResource;

class RedirectController extends Controller
{
    public function index(Organization $organization)
    {
        $redirects = $organization->redirects()->latest()->get();

        return RedirectResource::collection($redirects);
    }

    public function store(Organization $organization, RedirectStoreRequest $request)
    {
        $redirect = $organization->redirects()->create(
            $request->validated()
        );

        return new RedirectResource($redirect);
    }

    public function show(Organization $organization, Redirect $redirect)
    {
        return new RedirectResource($redirect);
    }

    public function update(Organization $organization, Redirect $redirect, RedirectUpdateRequest $request)
    {
        $redirect->update($request->validated());

        return new RedirectResource($redirect);
    }

    public function destroy(Organization $organization, Redirect $redirect)
    {
        $redirect->delete();

        return new RedirectResource($redirect);
    }
}
