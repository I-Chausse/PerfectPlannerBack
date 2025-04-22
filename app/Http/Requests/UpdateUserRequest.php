<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        $allowed = true;
        $user_id = request()->route('id');
        if ($user_id != $user->id) {
            $allowed = $user->hasPermission('UPDATEUSER');
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
            'name'=> 'required|string|max:255',
            'first_name'=> 'required|string|max:255',
            'user_name'=> 'required|string|max:255|unique:users,user_name',
            'email'=> 'required|string|email|max:255|unique:users,email',
            'password'=> 'required|string|min:8|confirmed',
            'avatar_id'=> 'nullable|numeric|exists:avatars,id',
            'role_id'=> 'required|numeric|exists:roles,id',
        ];
    }
}
