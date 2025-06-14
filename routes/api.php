<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\DomainItemController;
use App\Http\Controllers\InvitationTokenController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserAssignedToProject;
use App\Http\Middleware\CheckUserAssignedToUser;

Route::post(uri: "/login", action: [AuthController::class, "login"]);
Route::post("/register", [UserController::class, "storeWithToken"]); // Créer un utilisateur avec un token

Route::middleware(["auth:sanctum"])->group(function () {
    Route::post(uri: "/logout", action: [AuthController::class, "logout"]);

    ## my routes
    Route::get(uri: "/my-tasks", action: [TaskController::class, "myTasks"]);
    Route::get(
        uri: "/my-projects",
        action: [ProjectController::class, "myProjects"]
    );
    Route::get(uri: "/me", action: [UserController::class, "me"]);
    Route::put(uri: "/update-me", action: [UserController::class, "updateMe"]);
    Route::put(
        uri: "/update-my-password",
        action: [UserController::class, "updateMyPassword"]
    );

    ## routes admin
    Route::post("/generate-invitation-token", [
        InvitationTokenController::class,
        "generate",
    ]);
    Route::put(
        uri: "/users/{manager_id}/update-assignees",
        action: [UserController::class, "UpdateUsersAssignedToManager"]
    );

    ## routes for domain items
    Route::get(
        uri: "/get-items/{domain}",
        action: [DomainItemController::class, "getByDomain"]
    );

     Route::get(
        uri: "/get-avatars",
        action: [AvatarController::class, "index"]
    );

    ## routes for roles
    Route::get(
        uri: "/get-roles",
        action: [RoleController::class, "getRoles"]
    );

    ## routes for projects
    Route::get(
        uri: "/projects/{project_id}/tasks",
        action: [ProjectController::class, "getTaskByProject"]
    )->middleware([CheckUserAssignedToProject::class]);
    Route::get(
        uri: "/projects/{project_id}/users",
        action: [ProjectController::class, "getUsersByProject"]
    );
    Route::get(
        uri: "/projects/{project_id}/admins",
        action: [ProjectController::class, "getAdminsByProject"]
    );
    Route::get(
        uri: "/projects/{project_id}/assignables",
        action: [ProjectController::class, "getAssignablesByProject"]
    )->middleware([CheckUserAssignedToProject::class]);
    Route::put(
        uri: "/projects/{project_id}/update-assignees",
        action: [ProjectController::class, "UpdateUsersAssignedToProject"]
    );

    ## routes for tasks
    Route::get(
        uri: "/user/{user_id}/tasks",
        action: [TaskController::class, "getTasksByUser"]
    )->middleware([CheckUserAssignedToUser::class]);

    ## ressources
    Route::apiResource("tasks", TaskController::class);
    Route::apiResource("projects", ProjectController::class);
    Route::apiResource("users", UserController::class);
});
