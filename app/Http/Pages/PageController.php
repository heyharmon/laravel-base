<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Pages\Page;
use DDD\Domain\Sites\Site;

// Requests
use DDD\Http\Pages\Requests\PageStoreRequest;

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
