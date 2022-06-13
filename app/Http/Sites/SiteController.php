<?php

namespace DDD\Http\Sites;

use DDD\DDD\Controllers\Controller;
use DDD\DDD\Services\UrlService;
// Services
use DDD\Domain\Organizations\Organization;
// Domains
use DDD\Domain\Sites\Site;
use DDD\Http\Sites\Requests\SiteStoreRequest;
// Requests
use Illuminate\Http\Request;

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
            'scheme' => UrlService::getScheme($request->url),
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
