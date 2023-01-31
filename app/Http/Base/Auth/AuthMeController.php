<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Users\User;

// Resources
use DDD\Domain\Base\Users\Resources\UserResource;

class AuthMeController extends Controller
{
    public function __invoke(Request $request)
    {
        return new UserResource(auth()->user());
    }
}
