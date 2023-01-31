<?php

namespace DDD\Http\Base\Organizations;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Requests
use DDD\Domain\Base\Comments\Requests\CommentStoreRequest;

// Resources
use DDD\Domain\Base\Comments\Resources\CommentResource;

// Models
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Comments\Comment;

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
        $comment = $organization->comments()->make($request->validated());

        $request->user()->comments()->save($comment);

        return new CommentResource($comment);
    }

    public function destroy(Organization $organization, Comment $comment)
    {
        $comment->delete();

        return new CommentResource($comment);
    }
}
