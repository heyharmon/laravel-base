<?php

namespace DDD\Http\Pages;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;

// Requests
// use DDD\Domain\Pages\Requests\PageUpdateRequest;

// Resources
// use DDD\Domain\Pages\Resources\PageResource;

class PageBatchController extends Controller
{
    // public function update(Organization $organization, Page $page, PageUpdateRequest $request)
    // {
    //     $page->update($request->validated());
    //
    //     return new PageResource($page->load(['status', 'category', 'user']));
    // }

    public function destroy(Organization $organization, Request $request)
    {
        $pages = Page::whereIn('id', $request->ids)->delete();

        return response()->json([
            'message' => 'Pages successfully deleted.',
        ], 200);
    }
}
