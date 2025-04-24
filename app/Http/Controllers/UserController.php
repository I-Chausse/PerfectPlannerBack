<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\IndexUsersRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreUserWithTokenRequest;
use App\Http\Requests\UpdateMeRequest;
use App\Http\Requests\UpdateMyPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUsersAssignedToProjectRequest;
use App\Http\Resources\UserAugmentedResource;
use App\Http\Resources\UserResource;
use App\Models\InvitationToken;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexUsersRequest $request)
    {
        try {
            $users = User::all()->load(["role", "assignees"]);
            return UserAugmentedResource::collection($users);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $task = User::create($validatedData);
            return response()->json($task, 201);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowUserRequest $request, User $user)
    {
        try {
            return new UserAugmentedResource(
                $user->load(["role", "assignees"])
            );
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $validatedData = $request->validated();
            $user->update($validatedData);
            return response()->json($user, 200);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        try {
            $user->assignees()->detach();
            $user->tasks()->update(["user_id" => null]);
            $user->projects()->detach();
            $user->delete();
            return response()->json(null, 204);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function me()
    {
        try {
            $user = Auth::user();
            $user = User::where("id", $user->id)->get();
            return UserResource::collection($user);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function updateMe(UpdateMeRequest $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validated();
            $user->update($validatedData);
            return response()->json($user, 200);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function updateMyPassword(UpdateMyPasswordRequest $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validated();
            $user->update($validatedData);
            return response()->json($user, 200);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    public function storeWithToken(StoreUserWithTokenRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $token = InvitationToken::where(
                "token",
                $validatedData["token"]
            )->firstOrFail();

            if (!$token->isValid()) {
                return response()->json(
                    ["error" => "Le token est invalide ou déjà utilisé."],
                    400
                );
            }
            unset($validatedData["token"]);
            $validatedData["role_id"] = $token->role_id;

            $user = User::create($validatedData);
            Log::info("User ID: " . $user->id);
            $updateOk = $token->update(["user_id" => $user->id]);
            Log::info("Token ID: " . $token->id);
            Log::info("Token User ID: " . $token->user_id);

            return new UserResource($user);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function UpdateUsersAssignedToProject(
        UpdateUsersAssignedToProjectRequest $request
    ) {
        try {
            $validatedData = $request->validated();
            $project = request()->route("project");
            $usersToAssignIds = $validatedData["users_to_assign"];
            $project->users()->sync($usersToAssignIds);
            return response()->json($project, 200);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }
}
