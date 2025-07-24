<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Créer les utilisateurs
            User::factory()->count(10)->create(); // Crée 10 utilisateurs aléatoires

        // Créer 10 catégories
            Category::factory()->count(10)->create()->each(function ($category) {
            // Pour chaque catégorie, créer entre 4 et 7 produits liés
            Product::factory()->count(rand(4, 7))->create([
                'categorie_id' => $category->id
            ]);
        });
    }
}
