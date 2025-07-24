<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// 🔹 Page d'accueil accessible à tous
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/details', [ProductController::class, 'show'])->name('show');
Route::get('/produit/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/commande', [OrderController::class, 'submit'])->name('order.submit');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');



// 🔹 Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');



// 🔹 Dashboard (auth obligatoire)
Route::middleware('auth')->group(function () {

    Route::middleware(['admin'])->prefix('admin')->group(function () {
        // 🔹 Routes pour l'Admin (auth + admin obligatoire)
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        //Profile
        Route::get('/admin/profile', [UserController::class, 'editProfile'])->name('admin.profile.index');
        Route::post('/admin/profile', [UserController::class, 'updateProfile'])->name('admin.profile.update');


        // Gestion des produits
        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::delete('/admin/products/images/{id}', [ProductController::class, 'deleteImage'])->name('admin.products.deleteImage');


        // Gestion des catégories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Gestion des commandes
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

        // Gestion des utilisateurs
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});
