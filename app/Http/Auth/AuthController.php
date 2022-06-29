<?php

namespace DDD\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Users\User;

// Requests
use DDD\Http\Auth\Requests\AuthRegisterRequest;
use DDD\Http\Auth\Requests\AuthLoginRequest;

// Resources
use DDD\Domain\Users\Resources\UserResource;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => ['Registration successful'],
            'data' => [
                'access_token' => $token,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }

    public function login(AuthLoginRequest $request)
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
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => ['Tokens Revoked']
        ], 200);
    }

    public function me(Request $request)
    {
        return new UserResource(auth()->user());
    }
}
