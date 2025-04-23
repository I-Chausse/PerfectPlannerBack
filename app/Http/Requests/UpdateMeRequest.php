<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateMeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        if ($user == null) {
            return false;
        }
        $allowed = true;
        return $allowed;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // permet d'exclure les données de l'utilisateur connecté, qui vont être réecrites
        // 'unique:table,colonne'. except . ',colonne_id'
        return [
            'name'=> 'required|string|max:255',
            'first_name'=> 'required|string|max:255',
            'user_name'=> 'required|string|max:255|unique:users,user_name,'. Auth::user()->id . ',id',
            'email'=> 'required|string|email|max:255|unique:users,email,' . Auth::user()->id . ',id',
            'avatar_id'=> 'nullable|numeric|exists:avatars,id',
        ];
    }
}
