<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    // Retrieve a list of all projects from the database
    public function index()
    {
        $projects = Project::all();
        return response()->json(['projects' => $projects], 200);
    }

    // Create a project and store in the database
    public function store(Request $request)
    {   
        // Error: Not getting 422 HTTP response
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        
        $project = Project::create($validatedData);
     
        return response()->json([
            'message' => 'Project created successfully.',
            'data' => $project
        ], Response::HTTP_CREATED);
    }

    // Retrieve a project from the database
    public function show(Project $project)
    {
        return response()->json(['project' => $project], 200);
    }

    // Update a project from the database
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $project->update($validatedData);
        
        return response()->json([
            'message' => 'Project updated successfully', 
            'project' => $project,
        ], 200);
    }

    // Delete a project from the database
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully'], 200);
    }

    // Add a member to a project
    public function addMember(Request $request, Project $project)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
        ]);
    
        $memberId = $request->input('member_id');
        $project->members()->attach($memberId);
    
        return response()->json(['message' => 'Member added to the project successfully']);
    }

    public function getMembers(Project $project)
    {
        $members = $project->members;
        return response()->json(['members' => $members]);
    }
}
