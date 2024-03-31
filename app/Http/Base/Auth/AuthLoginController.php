<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use DDD\Http\Base\Auth\Requests\AuthLoginRequest;
use DDD\Domain\Base\Organizations\Resources\OrganizationResource;
use DDD\App\Controllers\Controller;

class AuthLoginController extends Controller
{
    public function __invoke(AuthLoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'credentials' => ['Credentials do not match.'],
                ],
            ], 422);
        }

        Auth::user()->tokens()->delete();

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'access_token' => $token,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role,
                'organization' => new OrganizationResource(Auth::user()->organization),
            ],
        ], 200);
    }
}
