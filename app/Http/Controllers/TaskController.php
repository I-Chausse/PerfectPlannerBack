<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Error;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::with(["status", "flag", "user"])->get();
            return TaskResource::collection($tasks);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $task = Task::create($validatedData);
            return new TaskResource($task);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            $task = $task->load(["status", "flag", "user"]);
            return new TaskResource($task);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $validatedData = $request->validated();
            $task->update($validatedData);
            return new TaskResource($task);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteTaskRequest $request, Task $task)
    {
        try {
            $task->delete();
            return response()->json(null, 204);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function myTasks()
    {
        try {
            $user = Auth::user();
            $tasks = $user
                ->tasks()
                ->with(["status", "flag", "user"])
                ->get();
            return TaskResource::collection($tasks);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function getTasksByUser($userId)
    {
        try {
            $tasks = Task::with(["status", "flag", "user"])
                ->where("user_id", $userId)
                ->get();
            return TaskResource::collection($tasks);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
