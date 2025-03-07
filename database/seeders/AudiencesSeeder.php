<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AudiencesSeeder extends Seeder
{
    public function run()
    {

        $films = DB::table('films')->pluck('name')->toArray();

        if (empty($films)) {
            $this->command->info('No hay películas en la tabla "films". No se insertaron audiencias.');
            return;
        }

        $audiences = [];

        for ($i = 0; $i < 25; $i++) {
            $audiences[] = [
                'film_name' => $films[array_rand($films)],
                'total_audiences' => rand(100, 10000),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('audiences')->insert($audiences);
    }
}
