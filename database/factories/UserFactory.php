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
     */
    public function definition(): array
    {
        return [
            
            'firstname' => $this->faker->firstName(), // Prénom
            'lastname' => $this->faker->lastName(), // Nom
            'email' => $this->faker->unique()->safeEmail(), // Email unique
            'email_verified_at' => now(), // Vérification de l'email
            'password' => bcrypt('password123'), // Mot de passe par défaut
            'tel' => $this->faker->phoneNumber(), // Numéro de téléphone
            'address' => $this->faker->address(), // Adresse
            'card_number' => $this->faker->creditCardNumber(), // Numéro de carte
            'card_expiry_date' => $this->faker->creditCardExpirationDate(), // Date d'expiration
            'card_cvv' => $this->faker->numberBetween(100, 999), // CVV à 3 chiffres
            'card_holder_name' => $this->faker->name(), // Nom du titulaire de la carte
            'remember_token' => Str::random(10), // Token de mémorisation
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
