<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateUsersAssignedToProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authorized = false;
        $user = Auth::user();
        $usersToAssignIds = request()->input("users_to_assign");
        ## si il n'y a pas d'utilisateur à assigner, on autorise la requête pour faire échouer la validation
        if (empty($usersToAssignIds)) {
            return true;
        }
        $users = User::whereIn("id", $usersToAssignIds)->get();
        if (
            $users
                ->load("role")
                ->some(
                    fn($user) => $user->role->code === "admin" ||
                        $user->role->code === "project_admin"
                )
        ) {
            $authorized = $user->hasPermission("ASSIGNMANAGERTOPROJECT");
        } else {
            $authorized = $user->hasPermission("ASSIGNUSERTOPROJECT");
        }
        return $authorized;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "users_to_assign" => ["present", "array"],
            "users_to_assign.*" => ["integer", "exists:users,id"],
        ];
    }
}
