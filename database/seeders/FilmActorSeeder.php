<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        if (empty($filmIds) || empty($actorIds)) {
            return; 
        }

        $relations = [];
        
        foreach ($filmIds as $filmId) {
           
            $randomActors = array_rand(array_flip($actorIds), rand(1, 3));
            
            foreach ((array) $randomActors as $actorId) {
                $relations[] = [
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        
        DB::table('films_actors')->insert($relations);
    }
}
