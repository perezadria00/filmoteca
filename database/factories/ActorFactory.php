<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'birthdate' => $this->faker->date(),
            'country' => substr($this->faker->country, 0, 30),
            'img_url' => $this->faker->imageUrl(),
        ];
    }
}
