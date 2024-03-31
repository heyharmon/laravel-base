<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use DDD\Http\Base\Auth\Requests\AuthPasswordForgotRequest;
use DDD\App\Controllers\Controller;

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
