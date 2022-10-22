<?php

namespace DDD\Http\Users;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Users\Invitation;

class InvitationController extends Controller
{
    public function index(Organization $organization)
    {
        $invitations = Invitation::latest()->get();

        return response()->json($invitations);
    }

    public function store(Organization $organization, Request $request)
    {
        $invitation = $organization->invitations()->create(
            $request->all()
        );

        return response()->json($invitation);
    }

    // public function show(Organization $organization, Invitation $invitation)
    // {
    //     return response()->json($invitation);
    // }

    // public function update(Organization $organization, Invitation $invitation, Request $request)
    // {
    //     $invitation->update($request->all());
    //
    //     return response()->json($invitation);
    // }

    public function destroy(Organization $organization, Invitation $invitation)
    {
        $invitation->delete();

        return response()->json($invitation);
    }
}
