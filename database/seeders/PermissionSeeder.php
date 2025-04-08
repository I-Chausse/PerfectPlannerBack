<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['id' => 11,'code' => 'ASSIGNUSERTOTASK', 'label' => 'Assigner un utilisateur à une tache', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21,'code' => 'CHANGEROLE', 'label' => 'Modifier le role', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 31,'code' => 'EDITTASK', 'label' => 'Editer une tâche', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 32, 'code' => 'CREATETASK', 'label' => 'Créer une tâche', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
