<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Actor;

class FilmActorSeeder extends Seeder
{
    public function run(): void
    {
        $films = Film::all();
        $actorIds = Actor::pluck('id')->toArray();

        foreach ($films as $film) {
            $randomActorIds = collect($actorIds)->random(rand(1, 3));
            $film->actors()->attach($randomActorIds);
        }
    }
}
