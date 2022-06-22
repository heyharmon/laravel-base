<?php

namespace DDD\Http\Test;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Users\User;
use DDD\Domain\Organizations\Organization;

class TestController extends Controller
{
    public function test(Request $request)
    {
        // return auth()->user();
        // return User::count();
        return User::Organization(auth()->user()->organization_id)->count();
    }

    public function users(Organization $organization, Request $request)
    {
        // return auth()->user();
        // return User::count();
        return User::Organization($organization->id)->get();
        // return $organization->users;
    }
}
