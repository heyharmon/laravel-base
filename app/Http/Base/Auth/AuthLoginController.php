<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDD\App\Controllers\Controller;

// Requests
use DDD\Http\Base\Auth\Requests\AuthLoginRequest;

// Resources
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;

class AuthLoginController extends Controller
{
    public function __invoke(AuthLoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'credentials' => ['Credentials do not match.']
                ]
            ], 422);
        }

        auth()->user()->tokens()->delete();

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'access_token' => $token,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'role' => auth()->user()->role,
                'organization' => new OrganizationResource(auth()->user()->organization),
            ]
        ], 200);
    }
}
