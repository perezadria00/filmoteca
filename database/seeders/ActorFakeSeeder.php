<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ActorFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $lastInsertedId = DB::table("actors")->max("id");

        for ($i = $lastInsertedId; $i < $lastInsertedId + 20; $i++) {
            DB::table("actors")->insert([
                "name" => substr($faker->firstName, 0,30),
                "surname"=>substr($faker->lastName, 0,30),
                "birthdate" => $faker->date,
                "country" => substr($faker->country, 0, 30),
                "img_url" => $faker->imageUrl(),
                "created_at" => $faker->dateTime(),
                "updated_at" => $faker->dateTime()

            ]);
        }
    }
}
