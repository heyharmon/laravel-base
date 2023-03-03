<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;
use Illuminate\Support\Facades\Password;

// Requests
use DDD\Http\Base\Auth\Requests\AuthRequestPasswordResetRequest;

class AuthRequestPasswordResetController extends Controller
{
    public function __invoke(AuthRequestPasswordResetRequest $request)
    {
        $resetStatus = Password::sendResetLink([
            'email' => $request->email
        ]);

        return response()->json([
            'message' => 'If this is a valid account email, you will recieve a password reset email.',
        ], 200);
    }
}
