<?php

namespace DDD\Http\Organizations;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Requests
use DDD\Domain\Media\Requests\StoreMediaRequest;

// Resources
use DDD\Domain\Media\Resources\MediaResource;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Media\Media;

class OrganizationMediaController extends Controller
{
    public function index(Organization $organization)
    {
        return MediaResource::collection(
            $organization->media->load('tags')->all()
        );
    }

    public function store(Organization $organization, StoreMediaRequest $request)
    {
        $media = $organization
            ->addMedia($request->file)
            ->toMediaCollection($request->collection);

        return new MediaResource($media->load('tags'));
    }

    public function destroy(Organization $organization, Media $media)
    {
        $media->delete();

        return response()->json(['message' => 'Media destroyed'], 200);
    }
}
