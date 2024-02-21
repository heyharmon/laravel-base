<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;
use DDD\Domain\Base\Organizations\Organization;
// Models
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;
use DDD\Domain\Base\Users\User;
// Requests
use DDD\Http\Base\Auth\Requests\AuthRegisterRequest;
// Resources
use Illuminate\Support\Facades\Hash;

class AuthRegisterController extends Controller
{
    public function __invoke(AuthRegisterRequest $request): JsonResponse
    {
        $organization = Organization::create([
            'title' => $request->organization_title,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin', // TODO: Remove
            'organization_id' => $organization->id,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

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
