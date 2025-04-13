<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorFakeSeeder extends Seeder
{
    public function run(): void
    {
        Actor::factory()->count(20)->create();
    }
}
