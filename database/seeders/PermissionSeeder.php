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
        DB::table("permissions")->insert([
            ## Users
            [
                "id" => 11,
                "code" => "ASSIGNUSERTOMANAGER",
                "label" => "Assigner un utilisateur à un manager",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 21,
                "code" => "CHANGEROLE",
                "label" => "Modifier le role",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 22,
                "code" => "CREATEUSER",
                "label" => "Créer un utilisateur",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 23,
                "code" => "EDITUSER",
                "label" => "Editer un utilisateur",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 24,
                "code" => "DELETEUSER",
                "label" => "Supprimer un utilisateur",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 25,
                "code" => "VIEWUSERTASKS",
                "label" => 'Voir les tâches d\'un utilisateur',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 26,
                "code" => "VIEWUSERS",
                "label" => "Voir un/les utilisateur",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            ## Tâches
            [
                "id" => 31,
                "code" => "EDITTASK",
                "label" => "Editer une tâche",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 32,
                "code" => "CREATETASK",
                "label" => "Créer une tâche",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 33,
                "code" => "ASSIGNUSERTOTASK",
                "label" => "Assigner un utilisateur à une tache",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 34,
                "code" => "DELETETASK",
                "label" => "Supprimer une tâche",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            ## Projets
            [
                "id" => 41,
                "code" => "ASSIGNUSERTOPROJECT",
                "label" => "Assigner un utilisateur à un projet",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 42,
                "code" => "ASSIGNMANAGERTOPROJECT",
                "label" => "Assigner un manager à un projet",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 43,
                "code" => "CREATEPROJECT",
                "label" => "Créer un projet",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 44,
                "code" => "EDITPROJECT",
                "label" => "Editer un projet",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => 45,
                "code" => "DELETEPROJECT",
                "label" => "Supprimer un projet",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
