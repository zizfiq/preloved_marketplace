<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [

            'user_id' => User::factory(),

            'name' => fake()->words(3, true),

            'description' => fake()->paragraph(),

            'price' => fake()->numberBetween(50000, 5000000),

            'category' => fake()->randomElement([
                'Fashion',
                'Elektronik',
                'Sepatu',
                'Tas',
                'Aksesoris'
            ]),

            'condition' => fake()->randomElement([
                'Baru',
                'Bekas'
            ]),

            'image' => 'products/default.jpg',

            'stock' => fake()->numberBetween(1,20),

            'status' => 'available'

        ];
    }
}