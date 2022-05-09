<?php

namespace DDD\Http\Sites;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Sites\Site;

// Requests
use DDD\Http\Sites\Requests\SiteStoreRequest;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::all();

        return response()->json($sites);
    }

    public function store(SiteStoreRequest $request)
    {
        $site = Site::create(
            $request->validated()
        );

        return response()->json($site);
    }

    public function show(Site $site)
    {
        return response()->json($site);
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return response()->json($site);
    }
}
