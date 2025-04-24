<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class UserRoleIsAdminOrProjectAdmin implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        $user = User::find($value)->load("role");
        if (
            empty($user) ||
            ($user->role->code !== "admin" &&
                $user->role->code !== "project_admin")
        ) {
            $fail('The user role must be "admin" or "project_admin.');
        }
    }
}
