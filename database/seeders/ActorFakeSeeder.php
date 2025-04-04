<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
use Faker\Factory as Faker;

class ActorFakeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Actor::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date(),
                'country' => substr($faker->country, 0, 30), 
                'img_url' => $faker->imageUrl(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
