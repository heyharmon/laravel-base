<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;
use DDD\Http\Base\Auth\Requests\AuthPasswordForgotRequest;
// Requests
use Illuminate\Support\Facades\Password;

class AuthPasswordForgotController extends Controller
{
    public function __invoke(AuthPasswordForgotRequest $request): JsonResponse
    {
        Password::sendResetLink([
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'If this is a valid account email, you will recieve a password reset email.',
        ], 200);
    }
}
