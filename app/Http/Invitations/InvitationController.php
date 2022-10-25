<?php

namespace DDD\Http\Invitations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DDD\App\Controllers\Controller;

// Emails
use DDD\Domain\Invitations\Mail\InvitationEmail;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Invitations\Invitation;

// Requests
use DDD\Domain\Invitations\Requests\InvitationStoreRequest;

// Resources
use DDD\Domain\Invitations\Resources\InvitationResource;

class InvitationController extends Controller
{
    public function index(Organization $organization)
    {
        $invitations = $organization->invitations()->latest()->get();

        return InvitationResource::collection($invitations);
    }

    public function store(Organization $organization, InvitationStoreRequest $request)
    {
        $invitation = $organization->invitations()->create(
            $request->validated()
        );

        Mail::to($invitation->email)->send(new InvitationEmail($invitation));

        return new InvitationResource($invitation);
    }

    public function show(Organization $organization, Invitation $invitation)
    {
        return new InvitationResource($invitation->load(['organization', 'user']));
    }

    // public function update(Organization $organization, Invitation $invitation, Request $request)
    // {
    //     $invitation->update($request->all());
    //
    //     return response()->json($invitation);
    // }

    public function destroy(Organization $organization, Invitation $invitation)
    {
        $invitation->delete();

        return new InvitationResource($invitation);
    }
}
