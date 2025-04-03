<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['code' => 'user', 'label' => 'User', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'project_admin', 'label' => 'Project Admin', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'admin', 'label' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
