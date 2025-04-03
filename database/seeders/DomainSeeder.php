<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('domains')->insert([
            ['id' => 1,'code' => 'LABELS', 'label' => 'labels', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'code' => 'PRIO', 'label' => 'priorités', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
