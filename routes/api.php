<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomainItemController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\CheckUserAssignedToProject;


Route::post(uri: '/login', action: [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get(uri: '/user', action: function (Request $request) {
        return $request->user();
    });

    ## my routes
    Route::get(uri: '/my-tasks', action: [TaskController::class, 'myTasks']);
    Route::get(uri: '/my-projects', action: [ProjectController::class, 'myProjects']);
    Route::get(uri: '/get-items/{domain}', action: [DomainItemController::class, 'getByDomain']);

    ## routes for projects
    Route::get(uri: '/projects/{project_id}/tasks', action: [ProjectController::class, 'getTaskByProject'])
    ->middleware([CheckUserAssignedToProject::class]);

    Route::get(uri: '/projects/{project_id}/users', action: [ProjectController::class, 'getUsersByProject'])
    ->middleware([CheckUserAssignedToProject::class]);
    Route::get(uri: '/projects/{project_id}/admins', action: [ProjectController::class, 'getAdminsByProject'])
    ->middleware([CheckUserAssignedToProject::class]);

    Route::get(uri: '/projects/{project_id}/assignables', action: [ProjectController::class, 'getAssignablesByProject'])
    ->middleware([CheckUserAssignedToProject::class]);

    ## ressources
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('projects', ProjectController::class);
});



