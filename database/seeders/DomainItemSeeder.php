<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('domain_items')->insert([
            ['id' => 101,'code' => 'FAIRE', 'label' => 'A Faire', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 1],
            ['id' => 102,'code' => 'COURS', 'label' => 'En cours', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 1],
            ['id' => 103,'code' => 'REVUE', 'label' => 'En revue', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 1],
            ['id' => 104,'code' => 'TERMINE', 'label' => 'Terminé', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 1],
            ['id' => 105,'code' => 'BLOQUE', 'label' => 'Bloqué', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 1],
            ['id' => 201, 'code' => 'BUG', 'label' => 'Bug', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 2],
            ['id' => 202, 'code' => 'URG', 'label' => 'Urgent', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 2],
            ['id' => 203, 'code' => 'IMP', 'label' => 'Important', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 2],
            ['id' => 204, 'code' => 'MIN', 'label' => 'Mineur', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 2],
            ['id' => 205, 'code' => 'OPT', 'label' => 'Optionel', 'created_at' => now(), 'updated_at' => now(), 'domain_id' => 2],
        ]);
    }
}
