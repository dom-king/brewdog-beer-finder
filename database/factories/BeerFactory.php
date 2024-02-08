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
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => fake()->sentence(),
            'tagline'      => fake()->sentence(),
            'first_brewed' => fake()->date('m/Y', '04/2007'),
            'description'  => fake()->paragraph(),
            'abv'          => fake()->randomFloat(2, 0, 10),
            'ibu'          => fake()->randomFloat(2, 0, 100),
            'image_url'    => fake()->imageUrl(),
            'food_pairing' => fake()->sentences(3),
        ];
    }
}
