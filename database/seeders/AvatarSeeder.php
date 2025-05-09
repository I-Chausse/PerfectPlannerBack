<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("avatars")->insert([
            [
                "id" => 1,
                "link" => "avatars/avatar1.png"
            ],
            [
                "id" => 2,
                "link" => "avatars/avatar2.png"
            ],
            [
                "id" => 3,
                "link" => "avatars/avatar3.png"
            ],
            [
                "id" => 4,
                "link" => "avatars/avatar4.png"
            ],
            [
                "id" => 5,
                "link" => "avatars/avatar5.png"
            ],
        ]);
    }
}
