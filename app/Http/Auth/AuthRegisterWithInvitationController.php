<?php

namespace DDD\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Users\User;
use DDD\Domain\Invitations\Invitation;

// Requests
use DDD\Http\Auth\Requests\AuthRegisterWithInvitationRequest;

// Resources
use DDD\Domain\Organizations\Resources\OrganizationResource;

class AuthRegisterWithInvitationController extends Controller
{
    public function __invoke(Invitation $invitation, AuthRegisterWithInvitationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'role' => 'editor', // TODO: Remove
            'organization_id' => $invitation->organization->id,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $invitation->delete();

        return response()->json([
            'message' => 'Registration successful',
            'data' => [
                'access_token' => $token,
                'name' => $user->name,
                'email' => $user->email,
                'organization' => new OrganizationResource($user->organization)
            ]
        ], 200);
    }
}
