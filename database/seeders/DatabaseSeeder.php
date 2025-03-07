<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        # ¡Tener en cuenta el orden en que se añade cada seeder para que no de error al ejecutar el comando db:seed!
        $this->call([
            FilmFakeSeeder::class,
            ActorFakeSeeder::class,
            FilmActorSeeder::class,
            AudiencesSeeder::class,
        ]);
    }
}
