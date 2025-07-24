<?php

namespace Database\Factories;

use App\Models\Category;
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
            'name' => $this->faker->word(), // Un mot aléatoire
            'description' => $this->faker->sentence(10), // Une phrase de 10 mots
            'price' => $this->faker->randomFloat(2, 5, 500), // Prix entre 5 et 500 €
            'categorie_id' => Category::inRandomOrder()->first()->id ?? 1,
            'image' => 'products/default.jpg', // Par défaut une image générique
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
