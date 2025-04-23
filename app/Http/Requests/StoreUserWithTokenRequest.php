<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserWithTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "first_name" => "required|string|max:255",
            "user_name" => "required|string|max:255|unique:users,user_name",
            "email" => "required|string|email|max:255|unique:users,email",
            "password" => "required|string|min:8|confirmed",
            "avatar_id" => "nullable|numeric|exists:avatars,id",
            "token" => "required|numeric|exists:invitation_tokens,token",
        ];
    }
}
