<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Pages\Page;
use DDD\Domain\Sites\Site;

class PageTagController extends Controller
{
    public function tag(Site $site, Page $page)
    {
        $page->tag(['tag-one', 'tag-two', 'Tag Three']);

        return response()->json($page->tags);
    }
}
