<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomainItemController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\CheckUserAssignedToProject;

Route::get(uri: '/user', action: function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post(uri: '/login', action: [AuthController::class, 'login']);

## my routes
Route::get(uri: '/my-tasks', action: [TaskController::class, 'myTasks'])
    ->middleware('auth:sanctum');

Route::get(uri: '/my-projects', action: [ProjectController::class, 'myProjects'])
->middleware('auth:sanctum');

Route::get(uri: '/get-items/{domain}', action: [DomainItemController::class, 'getByDomain'])
    ->middleware('auth:sanctum');


## routes for projects
Route::get(uri: '/projects/{project_id}/tasks', action: [ProjectController::class, 'getTaskByProject'])
->middleware(['auth:sanctum', CheckUserAssignedToProject::class]);

Route::get(uri: '/projects/{project_id}/users', action: [ProjectController::class, 'getUsersByProject'])
->middleware(['auth:sanctum', CheckUserAssignedToProject::class]);
Route::get(uri: '/projects/{project_id}/admins', action: [ProjectController::class, 'getAdminsByProject'])
->middleware(['auth:sanctum', CheckUserAssignedToProject::class]);

Route::get(uri: '/projects/{project_id}/assignables', action: [ProjectController::class, 'getAssignablesByProject'])
->middleware(['auth:sanctum', CheckUserAssignedToProject::class]);

## ressources
Route::apiResource('tasks', TaskController::class)->middleware(['auth:sanctum']);
Route::apiResource('projects', ProjectController::class)->middleware(['auth:sanctum']);