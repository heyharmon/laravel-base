<?php

namespace DDD\Http\Base\Teams;

use Illuminate\Http\Request;
use DDD\Domain\Base\Teams\Team;
use DDD\Domain\Base\Organizations\Organization;
use DDD\App\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Organization $organization)
    {
        $teams = $organization->teams;

        // TODO: Use an API Resource to return this
        return response()->json($teams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Organization $organization, Request $request)
    {
        $team = $organization->teams()->create([
            'title' => $request['title'],
        ]);

        // TODO: Use an API Resource to return this
        return response()->json($team);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization, Team $team)
    {
        // TODO: Use an API Resource to return this
        return response()->json($team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Organization $organization, Team $team, Request $request)
    {
        $team->update([
            'title' => $request['title'],
        ]);

        // TODO: Use an API Resource to return this
        return response()->json($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization, Team $team)
    {
        $team->delete();

        // TODO: Use an API Resource to return this
        return response()->json($team);
    }
}
