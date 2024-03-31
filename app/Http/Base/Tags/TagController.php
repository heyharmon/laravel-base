<?php

namespace DDD\Http\Base\Tags;

use Illuminate\Http\Request;
use DDD\Domain\Base\Tags\Tag;
use DDD\Domain\Base\Tags\Resources\TagResource;
use DDD\App\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::parents()->latest()->get();

        return TagResource::collection($tags);
    }

    public function store(Request $request)
    {
        $tag = Tag::create($request->all());

        return new TagResource($tag);
    }

    public function show(Tag $tag)
    {
        $tag = $tag->descendantsAndSelf()->get()->toTree();

        return new TagResource($tag->first());
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
