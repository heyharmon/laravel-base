<?php

namespace DDD\Http\Base\Invitations;

use Illuminate\Support\Facades\Mail;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Invitations\Resources\InvitationResource;
use DDD\Domain\Base\Invitations\Requests\InvitationStoreRequest;
use DDD\Domain\Base\Invitations\Mail\InvitationEmail;
use DDD\Domain\Base\Invitations\Invitation;
use DDD\App\Controllers\Controller;

class InvitationController extends Controller
{
    public function index(Organization $organization)
    {
        $invitations = $organization->invitations()
            ->latest()
            ->get();

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

    public function destroy(Organization $organization, Invitation $invitation)
    {
        $invitation->delete();

        return new InvitationResource($invitation);
    }
}
