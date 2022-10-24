<?php

namespace DDD\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDD\App\Controllers\Controller;

class AuthLogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => ['Tokens Revoked']
        ], 200);
    }
}
