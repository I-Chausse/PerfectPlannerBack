<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectPreviewResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserPreviewResource;
use App\Models\Project;
use Error;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $project = Project::create($validatedData);
            return response()->json($project, 201);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $validatedData = $request->validated();
            $project->update($validatedData);
            return response()->json($project, 200);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function myProjects() {
        try {
            $projects = Auth::user()->projects;
            return ProjectPreviewResource::collection($projects);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }  
    }

    public function getTaskByProject($projectId) {
        try {
            $project = Project::find($projectId);
            $tasks = $project->tasks()->with(['status', 'flag', 'user'])->get();
            return TaskResource::collection($tasks);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getUsersByProject($projectId) {
        try {
            $project = Project::find($projectId);
            $users = $project->users()->get();
            return response()->json($users);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getAdminsByProject($projectId) {
        try {
            $project = Project::find($projectId);
            $users = $project->admins()->get();
            return response()->json($users);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getAssignablesByProject($projectId) {
        try {
            $project = Project::find($projectId);
            $users = $project->assignables()->get();
            return UserPreviewResource::collection($users);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
