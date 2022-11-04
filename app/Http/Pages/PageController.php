<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Pages\Page;
use DDD\Domain\Sites\Site;

// Requests
use DDD\Domain\Pages\Requests\PageStoreRequest;
use DDD\Domain\Pages\Requests\PageUpdateRequest;

// Resources
use DDD\Domain\Pages\Resources\PageResource;

class PageController extends Controller
{
    public function index(Site $site)
    {
        $pages = $site->pages()
            ->with('category')
            ->latest()
            ->get();

        return PageResource::collection($pages);
    }

    public function store(Site $site, PageStoreRequest $request)
    {
        $page = $site->pages()->create(
            $request->validated()
        );

        return new PageResource($page->load(['category', 'user']));
    }

    public function show(Site $site, Page $page)
    {
        return new PageResource($page->load(['category', 'user']));
    }

    public function update(Site $site, Page $page, PageUpdateRequest $request)
    {
        $page->update($request->validated());

        return new PageResource($page->load(['category', 'user']));
    }

    public function destroy(Site $site, Page $page)
    {
        $page->delete();

        return new PageResource($page);
    }
}
