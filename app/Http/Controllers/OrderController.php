<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id){
        $order=Order::with('product')->findOrFail($id);
       
        return view('admin.orders.show',compact('order'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:500',
            'product_id' => 'required|exists:products,id',
        ]);

        // Enregistrer en base
        $order = Order::create($validated);

        // Récupérer le produit
        $product = Product::findOrFail($validated['product_id']);

        // Envoyer un mail à l'admin (remplace par ton email réel)
        Mail::to('hello@example.com')->send(new NewOrderNotification($order, $product));

        return back()->with('success', 'Commande envoyée avec succès ! Nous vous contacterons rapidement.');
    }
}
