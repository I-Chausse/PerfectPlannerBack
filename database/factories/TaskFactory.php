<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = rand(1, 3);
        if ($randomNumber == 1) {
            $assigned_id = null;
        } else {
            $assigned_id = User::where('role_id', 1)->inRandomOrder()->limit(1)->pluck('id')[0];
        }
        return [
            'name' => fake()->bs(),
            'description' => fake()->catchPhrase(),
            'remaining_time' => fake()->numberBetween(1, 12),
            'project_id' => fake()->numberBetween(1, 10),
            'domain_item_status_id' => fake()->numberBetween(101, 105),
            'domain_item_flag_id' => fake()->numberBetween(201, 205),
            'user_id' => $assigned_id,
        ];
    }
}
