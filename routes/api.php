<?php

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Ce fichier contient toutes les routes de l'API de notre application.
| Il est organisé en plusieurs sections :
| - Routes d'authentification
| - Routes publiques (accessible sans connexion)
| - Routes protégées pour les utilisateurs connectés
| - Routes protégées pour les administrateurs
*/

/*
|--------------------------------------------------------------------------
| 📌 Routes d'Authentification
|--------------------------------------------------------------------------
| Permet aux utilisateurs de s'inscrire, de se connecter et de récupérer
| leurs informations.
*/

Route::post('/register', [AuthController::class, 'register']); // Inscription
Route::post('/login', [AuthController::class, 'login']); // Connexion

// Routes protégées par auth:sanctum (nécessite une connexion)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Déconnexion
    Route::get('/user', [AuthController::class, 'user']); // Infos utilisateur connecté
});

/*
|--------------------------------------------------------------------------
| 📌 Routes Publiques (Accessible sans Connexion)
|--------------------------------------------------------------------------
| Ces routes permettent aux utilisateurs non connectés d'afficher les
| catégories et les produits sans restriction.
*/
Route::get('/categories', [CategoryController::class, 'index']); // Liste des catégories
Route::get('/categories/{id}', [CategoryController::class, 'show']); // Détails d'une catégorie

Route::get('/products', [ProductController::class, 'index']); // Liste des produits
Route::get('/products/{id}', [ProductController::class, 'show']); // Détails d'un produit

/*
|--------------------------------------------------------------------------
| 📌 Routes Utilisateur (Protégé par Auth)
|--------------------------------------------------------------------------
| Ces routes sont accessibles uniquement aux utilisateurs connectés.
| Un utilisateur peut voir et modifier son profil.
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile']); // Profil utilisateur connecté
    Route::put('/user/update', [UserController::class, 'update']); // Mettre à jour son propre compte
});




/*
|--------------------------------------------------------------------------
| 📌 Routes Administrateurs (Protégé par Auth + Admin)
|--------------------------------------------------------------------------
| Ces routes nécessitent une connexion et un rôle "admin".
| Seuls les administrateurs peuvent gérer les utilisateurs, catégories et produits.
*/
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // 🟢 Gestion des utilisateurs
    Route::get('/users', [UserController::class, 'index']); // Liste des utilisateurs
    Route::get('/users/{id}', [UserController::class, 'show']); // Détails d'un utilisateur
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur

    // 🟠 Gestion des catégories
    Route::post('/categories', [CategoryController::class, 'store']); // Ajouter une catégorie
    Route::put('/categories/{id}', [CategoryController::class, 'update']); // Modifier une catégorie
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']); // Supprimer une catégorie

    // 🔴 Gestion des produits
    Route::post('/products', [ProductController::class, 'store']); // Ajouter un produit
    Route::put('/products/{id}', [ProductController::class, 'update']); // Modifier un produit
    Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Supprimer un produit
});
