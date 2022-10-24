<?php

namespace DDD\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Users\User;

// Resources
use DDD\Domain\Users\Resources\UserResource;

class AuthMeController extends Controller
{
    public function __invoke(Request $request)
    {
        return new UserResource(auth()->user());
    }
}
