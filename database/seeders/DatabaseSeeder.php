<?php

namespace Database\Seeders;

use App\Models\Avatar;
use App\Models\User;
use App\Models\Project;
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
        $this->call([RoleSeeder::class, DomainSeeder::class, DomainItemSeeder::class, PermissionSeeder::class, PermissionRoleSeeder::class]);
        Avatar::factory(10)->create();
        User::factory(10)->create();
        Project::factory(10)->create();
        UserUser::factory(5)->create();
        Task::factory(100)->create();
    }
}
