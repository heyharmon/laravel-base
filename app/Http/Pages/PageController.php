<?php

namespace DDD\Http\Pages;

use DDD\DDD\Controllers\Controller;
use DDD\Domain\Pages\Page;
// Domains
use DDD\Domain\Sites\Site;
use DDD\Http\Pages\Requests\PageStoreRequest;
// Requests
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Site $site)
    {
        return response()->json($site->pages);
    }

    public function store(Site $site, PageStoreRequest $request)
    {
        $page = $site->pages()->create(
            $request->validated()
        );

        return response()->json($page);
    }

    // public function show(Site $site)
    // {
    //     return response()->json($site);
    // }
    //
    // public function destroy(Site $site)
    // {
    //     $site->delete();
    //
    //     return response()->json($site);
    // }
}
