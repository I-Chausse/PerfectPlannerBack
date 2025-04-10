<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $task = Task::create($validatedData);
            return response()->json($task, 201);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $validatedData = $request->validated();
            $task->update($validatedData);
            return response()->json($task, 200);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function myTasks() {
        try {
            $user = Auth::user();
            $tasks = $user->tasks()->with(['status', 'flag', 'user'])->get();
            return TaskResource::collection($tasks);
        }
        catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
