<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectPreviewRessource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserPreviewRessource;
use App\Models\Project;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function myProjects() {
        $projects = Auth::user()->projects;
        return ProjectPreviewRessource::collection($projects);
    }

    public function getTaskByProject($projectId) {
        $project = Project::find($projectId);
        $tasks = $project->tasks()->with(['status', 'flag', 'user'])->get();
        return TaskResource::collection($tasks);
    }

    public function getUsersByProject($projectId) {
        $project = Project::find($projectId);
        $users = $project->users()->get();
        return response()->json($users);
    }

    public function getAdminsByProject($projectId) {
        $project = Project::find($projectId);
        $users = $project->admins()->get();
        return response()->json($users);
    }

    public function getAssignablesByProject($projectId) {
        $project = Project::find($projectId);
        $users = $project->assignables()->get();
        return UserPreviewRessource::collection($users);
    }
}
