<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{   
    // Retrieve a list of all teams from the database
    public function index()
    {
        $teams = Team::with('members')->get();
        return response()->json(['teams' => $teams], 200);
    }

    // Create a team and store in the database
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        
        $team = Team::create($validatedData);
     
        return response()->json([
            'message' => 'Team created successfully.',
            'data' => $team
        ], Response::HTTP_CREATED);
    }

    // Retrieve a team from the database
    public function show(Team $team)
    {
        return response()->json(['team' => $team], 200);
    }

    // Update a team
    public function update(Request $request, Team $team)
    {
        // Error: Not getting 422 HTTP response
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $team->update($validatedData);

        return response()->json([
            'message' => 'Team updated successfully', 
            'team' => $team,
        ], 200);
    }

    // Delete a team from the database
    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json(['message' => 'Team deleted successfully'], 200);
    }

    // Fetch members of a specific team
    public function getMembers(Team $team)
    {
        $members = $team->members;
        return response()->json(['members' => $members]);
    }
}
