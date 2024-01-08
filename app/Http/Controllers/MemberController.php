<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    // Retrieve a list of all members from the database
    public function index()
    {
        $members = Member::with('team')->get();
        return response()->json(['members' => $members], 200);
    }

    // Create a member and store in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'city' => 'nullable|string|max:60',
            'state' => 'nullable|string|max:2',
            'country' => 'nullable|string|max:60',
            'team_id' => 'required|integer'
        ]);
        
        $member = Member::create($validatedData);
        $member = $member->load('team');
     
        return response()->json([
            'message' => 'Member created successfully.',
            'data' => $member
        ], Response::HTTP_CREATED);
    }

    public function show(Member $member)
    {
        return response()->json(['member' => $member], 200);
    }

    public function update(Request $request, Member $member)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'city' => 'nullable|string|max:60',
            'state' => 'nullable|string|max:2',
            'country' => 'nullable|string|max:60',
            'team_id' => 'required|integer'
        ]);

        $member->update($validatedData);
        $member = $member->load('team');
        
        return response()->json([
            'message' => 'Member updated successfully', 
            'member' => $member,
        ], 200);
    }

    public function destroy(Member $member)
    {   
        $member->delete();
        return response()->json(['message' => 'Member deleted successfully'], 200);
    }

    // Update the team of a member
    public function updateTeam(Request $request, Member $member)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id', 
        ]);

        $teamId = $request->input('team_id');

        $member->team_id = $teamId;
        $member->save();

        return response()->json(['message' => 'Team updated successfully.']);
    }
}
