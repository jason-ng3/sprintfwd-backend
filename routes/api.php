<?php

use Illuminate\Support\Facades\Route;;

// Resource routes
Route::apiResource('teams', TeamController::class);
Route::apiResource('members', MemberController::class);
Route::apiResource('projects', ProjectController::class);

use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;

// Custom routes
Route::patch('/members/{member}/update-team', [MemberController::class, 'updateTeam']);
Route::get('/teams/{team}/members', [TeamController::class, 'getMembers']);
Route::patch('/projects/{project}/add-member', [ProjectController::class, 'addMember']);
Route::get('/projects/{project}/members', [ProjectController::class, 'getMembers']);
