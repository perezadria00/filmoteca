<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmFakeSeeder extends Seeder
{
    public function run(): void
    {
        Film::factory()->count(20)->create();
    }
}
