<?php

namespace DDD\Http\Base\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DDD\Domain\Base\Users\Resources\UserResource;
use DDD\App\Controllers\Controller;

class AuthMeController extends Controller
{
    public function __invoke(Request $request)
    {
        return new UserResource(Auth::user());
    }
}
