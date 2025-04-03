<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectUser>
 */
class ProjectUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $userId = User::inRandomOrder()->limit(1)->pluck('id')[0];
            $projectId = Project::inRandomOrder()->limit(1)->pluck('id')[0];
            $relationExists = ProjectUser::where('user_id', $userId)
                                               ->where('project_id', $projectId)
                                               ->exists();
        } while ($relationExists);
        return [
            'user_id' => $userId,
            'project_id' => $projectId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
