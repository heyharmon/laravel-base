<?php

namespace DDD\Http\Tags;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Tags\TagGroup;

// Resources
use DDD\Http\Tags\Resources\TagGroupResource;

class TagGroupController extends Controller
{
    public function index()
    {
        $groups = TagGroup::get();

        return TagGroupResource::collection($groups);
    }

    public function store(Request $request)
    {
        $group = TagGroup::create($request->all());

        return new TagGroupResource($group);
    }

    public function show(TagGroup $group)
    {
        return new TagGroupResource($group->load('tags'));
    }

    public function update(TagGroup $group, Request $request)
    {
        $group->update($request->all());

        return new TagGroupResource($group->load('tags'));
    }

    public function destroy(TagGroup $group)
    {
        $group->delete();

        return new TagGroupResource($group);
    }
}
