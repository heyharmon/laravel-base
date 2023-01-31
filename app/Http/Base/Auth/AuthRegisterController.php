<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Users\User;

// Requests
use DDD\Http\Base\Auth\Requests\AuthRegisterRequest;

// Resources
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;

class AuthRegisterController extends Controller
{
    public function __invoke(AuthRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin', // TODO: Remove
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        // TODO: Create an organization for this user

        return response()->json([
            'message' => 'Registration successful',
            'data' => [
                'access_token' => $token,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }
}
