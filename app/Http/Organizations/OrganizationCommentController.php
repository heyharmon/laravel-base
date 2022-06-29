<?php

namespace DDD\Http\Organizations;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Requests
use DDD\Domain\Comments\Requests\CommentStoreRequest;

// Resources
use DDD\Domain\Comments\Resources\CommentResource;

// Domains
use DDD\Domain\Organizations\Organization;

class OrganizationCommentController extends Controller
{
    public function index(Organization $organization)
    {
        return CommentResource::collection(
            $organization->comments()->with(['children', 'user'])->get()
        );
    }

    public function store(Organization $organization, CommentStoreRequest $request)
    {
        $comment = $organization->comments()->make([
            'body' => $request->body
        ]);

        $request->user()->comments()->save($comment);

        return new CommentResource($comment);
    }
}
