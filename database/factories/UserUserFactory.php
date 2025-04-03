<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserUser>
 */
class UserUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $adminId = User::whereIn('role_id', [2, 3])->inRandomOrder()->limit(1)->pluck('id')[0];
            $assigneeId = User::where('role_id', 1)->inRandomOrder()->limit(1)->pluck('id')[0];
            $relationExists = UserUser::where('admin_user_id', $adminId)
                                               ->where('assignee_user_id', $assigneeId)
                                               ->exists();
        } while ($relationExists);
    
        return [
            'admin_user_id' => $adminId,
            'assignee_user_id' => $assigneeId,
        ];
    }
}
