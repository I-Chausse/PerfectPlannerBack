<?php

namespace Database\Seeders;

use App\Models\Avatar;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Role;
use App\Models\UserUser;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DomainSeeder::class,
            DomainItemSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
        ]);
        $roles = Role::all();
        $avatars = Avatar::factory(10)->create();
        $users = User::factory(10)
            ->make()
            ->each(function ($user) use ($avatars, $roles) {
                $user->avatar_id = $avatars->random()->id;
                $user->role_id = $roles->random()->id;
                $user->save();
            });
        $projects = Project::factory(10)->create();
        Task::factory(100)
            ->make()
            ->each(function ($task) use ($projects) {
                $task->project_id = $projects->random()->id;
                $task->save();
            });
        $users->each(function ($user) use ($projects) {
            $projectIds = $projects->random(rand(1, 5))->pluck("id");
            $user->projects()->attach($projectIds);
        });
    }
}
