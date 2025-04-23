<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_Restaurant' => fake()->company(),
            'adresse' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'notation' => fake()->randomFloat(1, 1, 5), 
            'status' => fake()->randomElement(['accepted', 'rejected', 'En Attent']),
            'image' => 'restaurants/' . fake()->image(storage_path('app/public/restaurants'), 640, 480, 'food', false),
            'zone_Livraison' => fake()->city(),
        ];
    }
}
