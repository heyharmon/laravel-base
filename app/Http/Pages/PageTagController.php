<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Pages\Page;
use DDD\Domain\Sites\Site;

class PageTagController extends Controller
{
    public function tag(Site $site, Page $page, Request $request)
    {
        $page->tag(['parent-one', 'parent-two']);

        return response()->json($page->tags);
    }

    public function untag(Site $site, Page $page, Request $request)
    {
        $page->untag();

        return response()->json($page->tags);
    }

    public function retag(Site $site, Page $page, Request $request)
    {
        $page->retag(['parent-two', 'parent-three']);

        return response()->json($page->tags);
    }
}
