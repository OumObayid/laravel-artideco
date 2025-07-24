<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID du produit
            $table->string('name'); // Nom du produit
            $table->text('description'); // Description du produit
            $table->decimal('price', 10, 2); // Prix du produit
            $table->unsignedBigInteger('categorie_id')->nullable(); // Permet de le rendre NULL si supprimé
            $table->string('image')->nullable(); // Stocke seulement le chemin de l'image
            $table->foreign('categorie_id')
                ->references('id')->on('categories')
                ->onDelete('set null');
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
