<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class FilmFakeSeeder extends Seeder
{
    public function run(): void
    {


        $faker = Faker::create();

        $lastInsertedId = DB::table("films")->max("id");

        for ($i = $lastInsertedId; $i < $lastInsertedId + 20; $i++) {
            DB::table("films")->insert([
                "name" => $faker->sentence(3),
                "year" => $faker->year,
                "genre" => $faker->word,
                "country" => substr($faker->country, 0, 30),
                "duration" => $faker->numberBetween(60, 240),
                "img_url" => $faker->imageUrl(),
                "created_at" => $faker->dateTime(),
                "updated_at" => $faker->dateTime()
            ]);
        }

        }
    }

