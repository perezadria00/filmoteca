<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'year' => $this->faker->year,
            'genre' => $this->faker->word,
            'country' => substr($this->faker->country, 0, 30),
            'duration' => $this->faker->numberBetween(60, 240),
            'img_url' => $this->faker->imageUrl(),
        ];
    }
}
