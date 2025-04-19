<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */public function definition(): array
        {
            return [
                'nom_utilisateur' => fake()->lastName(),
                'prenom' => fake()->firstName(),
                'email' => fake()->unique()->safeEmail(),
                'password' => static::$password ??= Hash::make('password'),
                'telephone' => fake()->phoneNumber(),
                'dateCreation' => now(),
                'statut' => 'actif',
                'role_id' => 2, 
                'vehicule' => fake()->randomElement(['Voiture', 'Moto', 'Vélo', null]),
                'zone' => fake()->city(),
            ];
        }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
