<?php

namespace DDD\Http\Users;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Users\UserInvitation;

// Requests
use DDD\Domain\Users\Requests\UserInvitationStoreRequest;

// Resources
use DDD\Domain\Users\Resources\UserInvitationResource;

class UserInvitationController extends Controller
{
    public function index(Organization $organization)
    {
        $invitations = $organization->userInvitations()->latest()->get();

        return UserInvitationResource::collection($invitations);
    }

    public function store(Organization $organization, UserInvitationStoreRequest $request)
    {
        $invitation = $organization->userInvitations()->create(
            $request->validated()
        );

        return new UserInvitationResource($invitation);
    }

    // public function show(Organization $organization, UserInvitation $invitation)
    // {
    //     return response()->json($invitation);
    // }

    // public function update(Organization $organization, UserInvitation $invitation, Request $request)
    // {
    //     $invitation->update($request->all());
    //
    //     return response()->json($invitation);
    // }

    public function destroy(Organization $organization, UserInvitation $invitation)
    {
        $invitation->delete();

        return new UserInvitationResource($invitation);
    }
}
