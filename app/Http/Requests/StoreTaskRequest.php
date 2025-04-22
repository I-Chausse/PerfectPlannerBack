<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\DomainItem;
use App\Rules\DomainItemInSpecificDomain;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        $allowed = $user->hasPermission('CREATETASK');
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
            'description' => 'nullable|string|max:1000',
            'remaining_time' => 'nullable|numeric|min:0',
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
            'user_id' => [
                'nullable',
                'numeric',
                'exists:users,id',
            ],
        ];
    }
}
