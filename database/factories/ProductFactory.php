<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake('es_ES')->realText(50),
            'price' => fake()->numberBetween(1000, 1000000),
            'stock' => fake()->numberBetween(0, 100),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
