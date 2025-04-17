<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_roles')->insert([
            ['permission_id' => 11, 'role_id' => 2,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 11, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 21, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 31, 'role_id' => 1,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 31, 'role_id' => 2,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 31, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 32, 'role_id' => 1,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 32, 'role_id' => 2,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 33, 'role_id' => 2,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 33, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 32, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 41, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 42, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 43, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
            ['permission_id' => 44, 'role_id' => 3,'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
