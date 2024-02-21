<?php

namespace DDD\Http\Base\Auth;

use DDD\App\Controllers\Controller;
use DDD\Domain\Base\Invitations\Invitation;
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;
// Models
use DDD\Domain\Base\Users\User;
use DDD\Http\Base\Auth\Requests\AuthRegisterWithInvitationRequest;
// Requests
use Illuminate\Http\JsonResponse;
// Resources
use Illuminate\Support\Facades\Hash;

class AuthRegisterWithInvitationController extends Controller
{
    public function __invoke(Invitation $invitation, AuthRegisterWithInvitationRequest $request): JsonResponse
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
                'role' => $user->role,
                'organization' => new OrganizationResource($user->organization),
            ],
        ], 200);
    }
}
