<?php

namespace DDD\Http\Sites;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Services
use DDD\App\Services\UrlService;

// Domains
use DDD\Domain\Sites\Site;
use DDD\Domain\Organizations\Organization;

// Requests
use DDD\Http\Sites\Requests\SiteStoreRequest;

class SiteController extends Controller
{
    public function index(Organization $organization)
    {
        $sites = $organization->sites;

        return response()->json($sites);
    }

    public function store(Organization $organization, SiteStoreRequest $request)
    {
        $site = $organization->sites()->create([
            'start_url' => $request->url,
            'host' => UrlService::getHost($request->url),
            'scheme' => UrlService::getScheme($request->url)
        ]);

        return response()->json($site);
    }

    public function show(Organization $organization, Site $site)
    {
        return response()->json($site);
    }

    public function destroy(Organization $organization, Site $site)
    {
        $site->delete();

        return response()->json($site);
    }
}
