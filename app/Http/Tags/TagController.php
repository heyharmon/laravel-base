<?php

namespace DDD\Http\Tags;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Tags\TagGroup;
use DDD\Domain\Tags\Tag;

// Resources
use DDD\Http\Tags\Resources\TagResource;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $group = TagGroup::where('slug', $request->group_slug)->firstOrFail();

        $tag = $group->tags()->create([
            'title' => $request->title
        ]);

        return new TagResource($tag);
    }

    public function update(Tag $tag, Request $request)
    {
        $tag->update($request->all());

        return new TagResource($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return new TagResource($tag);
    }
}
