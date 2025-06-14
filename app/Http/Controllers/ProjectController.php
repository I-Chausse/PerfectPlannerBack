<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateUsersAssignedToProjectRequest;
use App\Http\Resources\ProjectPreviewResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserPreviewResource;
use App\Models\Project;
use App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectName = request()->query('projectname');
        if ($projectName) {
            $projects = Project::where('project_name', 'LIKE', "%$projectName%")->get()->load(["admins", "users"]);
        }
        else {
            $projects = Project::all()->load(["admins", "users"]);
        }
        return ProjectPreviewResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $project = Project::create($validatedData);
            return new ProjectPreviewResource($project);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(["admins", "users"]);
        return new ProjectPreviewResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $validatedData = $request->validated();
            $project->update($validatedData);
            return new ProjectPreviewResource($project);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProjectRequest $request, Project $project)
    {
        try {
            $project->users()->detach();
            $project->admins()->detach();
            $project->delete();
            return response()->json(null, 204);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function myProjects()
    {
        try {
            $projects = Auth::user()->projects;
            return ProjectPreviewResource::collection($projects);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getTaskByProject($projectId)
    {
        try {
            $project = Project::find($projectId);
            $task_name = request()->query('search');
            if ($task_name) {
                $tasks = $project
                ->tasks()
                ->where('name', 'LIKE', "%$task_name%")
                ->with(["status", "flag", "user"])
                ->get();
            }
            else {
                $tasks = $project
                ->tasks()
                ->with(["status", "flag", "user"])
                ->get();
            }
            return TaskResource::collection($tasks);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getUsersByProject($projectId)
    {
        try {
            $project = Project::find($projectId);
            $users = $project->users()->get();
            return UserPreviewResource::collection($users);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getAdminsByProject($projectId)
    {
        try {
            $project = Project::find($projectId);
            $users = $project->admins()->get();
            return UserPreviewResource::collection($users);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getAssignablesByProject($projectId)
    {
        try {
            $project = Project::find($projectId);
            $users = $project->assignables()->get();
            return UserPreviewResource::collection($users);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function updateUsersAssignedToProject(
        UpdateUsersAssignedToProjectRequest $request,
        int $projectId
    ) {
        try {
            $project = Project::find($projectId);
            $usersToAssignIds = $request->validated()["users_to_assign"];
            $usersToAssign = User::whereIn("id", $usersToAssignIds)->get();
            $project->users()->sync($usersToAssign);
            return new ProjectPreviewResource($project);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
