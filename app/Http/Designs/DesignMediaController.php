<?php

namespace DDD\Http\Designs;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Designs\Design;
use DDD\Domain\Designs\Media;

// Resources
use DDD\Domain\Media\Resources\MediaResource;

class DesignMediaController extends Controller
{
    public function store(Organization $organization, Design $design, Request $request)
    {
        // TODO: Add a request class to this
        $media = $design
            ->addMedia($request->file)
            ->toMediaCollection('fonts');

        return new MediaResource($media->load('tags'));
    }
}
