<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;

// Requests
use DDD\Domain\Pages\Requests\PageStoreRequest;
use DDD\Domain\Pages\Requests\PageUpdateRequest;

// Resources
use DDD\Domain\Pages\Resources\PageResource;

class PageController extends Controller
{
    public function index(Organization $organization)
    {
        $pages = $organization->pages()
            ->with(['status', 'category'])
            ->latest()
            ->get();

        return PageResource::collection($pages);
    }

    public function store(Organization $organization, PageStoreRequest $request)
    {
        $page = $organization->pages()->create(
            $request->validated()
        );

        return new PageResource($page->load(['status', 'category', 'user']));
    }

    public function show(Organization $organization, Page $page)
    {
        return new PageResource($page->load(['status', 'category', 'user']));
    }

    public function update(Organization $organization, Page $page, PageUpdateRequest $request)
    {
        $page->update($request->validated());

        return new PageResource($page->load(['status', 'category', 'user']));
    }

    public function destroy(Organization $organization, Page $page)
    {
        $page->delete();

        return new PageResource($page);
    }
}
