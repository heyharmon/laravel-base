<?php

namespace DDD\Http\Sites;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Sites\Site;

// Requests
use DDD\Http\Sites\Requests\SiteRequest;
use DDD\Http\Sites\Requests\SiteStoreRequest;

// Services
use DDD\App\Services\UrlService;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::all();

        return response()->json($sites);
    }

    public function store(SiteStoreRequest $request)
    {
        $site = Site::create([
            'host' => UrlService::getHost($request['url'])
        ]);

        return response()->json($site);
    }

    public function show(SiteRequest $request)
    {
        $site = Site::where('host', '=', UrlService::getHost($request['url']))
            ->firstOrFail();

        return response()->json($site);
    }

    public function destroy(SiteRequest $request)
    {
        $site = Site::where('host', '=', UrlService::getHost($request['url']))
            ->firstOrFail();

        $site->delete();

        return response()->json($site);
    }
}
