<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_Menu' => $this->faker->words(2, true),
            'isActif' => $this->faker->boolean(90),
            'restaurant_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
