<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;

class AuthLogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked',
        ], 200);
    }
}
