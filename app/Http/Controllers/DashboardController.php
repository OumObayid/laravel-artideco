<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    // Afficher le tableau de bord utilisateur
    public function userDashboard()
    {
        return view('user.dashboard');
    }

    // Afficher le tableau de bord administrateur
    public function adminDashboard()
    {
        //  return view('admin.dashboard');

        if (!Gate::allows('access-admin')) {
            abort(403, "Accès refusé"); // Bloquer l'accès si ce n'est pas un admin
        }
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count(); // si tu gères les commandes
        $userCount = User::Count();
        $latestOrders = Order::with('product')->latest()->take(5)->get();

        return view('admin.dashboard', compact('productCount', 'categoryCount', 'orderCount', 'userCount','latestOrders'));
    }
}
