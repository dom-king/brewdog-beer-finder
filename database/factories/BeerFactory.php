<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BeerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'id'   => $this->faker->uuid,
            'name' => $this->faker->word,
            'tagline' => $this->faker->sentence,
            'first_brewed' => $this->faker->date('m/Y', '04/2007'),
            'description' => $this->faker->paragraph,
            'abv' => $this->faker->randomFloat(2, 0, 10),
            'ibu' => $this->faker->randomFloat(2, 0, 100),
            'image_url' => $this->faker->imageUrl(),
            'food_pairing' => $this->faker->sentences(3),
        ];
    }
}
