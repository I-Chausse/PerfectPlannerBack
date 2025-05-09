<?php

namespace App\Http\Requests;

use App\Rules\UserRoleIsAdminOrProjectAdmin;
use App\Rules\UserRoleIsUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUsersAssignedToManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission("ASSIGNUSERTOMANAGER");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // On merge le manager_id dans la requête pour l'utiliser dans les règles de validation
        request()->merge([
            "manager_id" => request()->route("manager_id"),
        ]);
        return [
            "users_to_assign" => ["present", "array"],
            "users_to_assign.*" => [
                "integer",
                "exists:users,id",
                new UserRoleIsUser(),
            ],
            "manager_id" => [
                "required",
                "integer",
                "exists:users,id",
                new UserRoleIsAdminOrProjectAdmin(),
            ],
        ];
    }
}
