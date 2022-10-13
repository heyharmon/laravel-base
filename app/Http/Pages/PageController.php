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

class PageController extends Controller
{
    public function index(Site $site)
    {
        $pages = $site->pages()->latest()->get();
        // $pages = $site->pages()->withAnyTag(['tag-two'])->get();
        // $pages = $site->pages()->withAllTags(['tag-two', 'tag-three'])->get();

        return response()->json($pages);
    }

    public function store(Site $site, PageStoreRequest $request)
    {
        $page = $site->pages()->create(
            $request->validated()
        );

        return response()->json($page);
    }

    public function show(Site $site, Page $page)
    {
        return response()->json($page);
    }

    public function update(Site $site, Page $page, PageUpdateRequest $request)
    {
        $page->update($request->validated());

        return response()->json($page);
    }

    public function destroy(Site $site, Page $page)
    {
        $page->delete();

        return response()->json($page);
    }
}
