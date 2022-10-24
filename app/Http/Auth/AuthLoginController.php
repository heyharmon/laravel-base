<?php

namespace DDD\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDD\App\Controllers\Controller;

// Requests
use DDD\Http\Auth\Requests\AuthLoginRequest;

// Resources
use DDD\Domain\Organizations\Resources\OrganizationResource;

class AuthLoginController extends Controller
{
    public function __invoke(AuthLoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'message' => ['Credentials do not match']
            ], 401);
        }

        auth()->user()->tokens()->delete();

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => ['Login successful'],
            'data' => [
                'access_token' => $token,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'organization' => new OrganizationResource(auth()->user()->organization),
            ]
        ], 200);
    }
}
