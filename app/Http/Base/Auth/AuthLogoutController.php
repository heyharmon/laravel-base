<?php

namespace DDD\Http\Base\Auth;

use DDD\App\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthLogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked',
        ], 200);
    }
}
