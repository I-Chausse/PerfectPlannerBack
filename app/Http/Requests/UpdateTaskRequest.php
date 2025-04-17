<?php

namespace App\Http\Requests;

use App\Rules\DomainItemInSpecificDomain;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        $allowed = $user->hasPermission('EDITTASK');
        $user_id = request()->input('user_id'); // Récupérer l'assignee_id de la requête
        if ($allowed && $user_id != null && $user_id != $user->id) {
            $allowed = $user->hasPermission('ASSIGNUSERTOTASK');
        }
        return $allowed;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'remaining_time' => 'nullable|numeric',
            'project_id' => 'required|exists:projects,id',
            'domain_item_status_id' => [
                'required',
                'numeric',
                new DomainItemInSpecificDomain('status'),
            ],
            'domain_item_flag_id' => [
                'required',
                'numeric',
                new DomainItemInSpecificDomain('flags'),
            ],
            'user_id' => 'nullable|numeric|exists:users,id',
        ];
    }
}
