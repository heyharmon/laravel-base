<?php

namespace DDD\Http\Tags;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Tags\Tag;

class TagController extends Controller
{
    public function index()
    {
        // $tags = Tags::all();
        $tags = Tag::get();

        // TODO: Use an API Resource to return this
        return response()->json($tags);
    }

    public function store(Request $request)
    {
        $tag = Tag::create($request->all());

        // TODO: Use an API Resource to return this
        return response()->json($tag);
    }

    public function show(Tag $tag)
    {
        // TODO: Use an API Resource to return this
        return response()->json($tag);
    }

    public function update(Tag $tag, Request $request)
    {
        $tag->update($request->all());

        // TODO: Use an API Resource to return this
        return response()->json($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        // TODO: Use an API Resource to return this
        return response()->json($tag);
    }
}
