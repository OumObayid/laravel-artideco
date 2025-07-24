<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 📌 Afficher tous les produits (accessible à tous)
     */

    public function home()
    {
        $products = Product::with('category')->get();

        return view('home', compact('products'));
    }


    // Affichage des produits (Admin)
    public function index()
    {
        // $products = Product::all();
        // $products = Product::with('category')->get();
        $products = Product::latest()->paginate(10); // pagination

        return view('admin.products.index', compact('products'));
    }


    /**
     * 📌 Afficher un produit par son ID (accessible à tous)
     */
    public function show($id)
    {
        // $product = Product::find($id);

        // if (!$product) {
        //     return response()->json(['message' => 'Produit non trouvé'], 404);
        // }
        $product = Product::with('category')->find($id);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Produit non trouvé');
        }

        return view('products.show', compact('product'));
    }

    /**
     * 🔒 Ajouter un nouveau produit (ADMIN uniquement)
     */
    // Formulaire d'ajout d'un produit
    public function create()
    {
        $categories = Category::all();
        // dd($categories); // Affiche toutes les catégories et arrête l'exécution
        return view('admin.products.create', compact('categories'));
    }


    // Ajout d'un produit
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'colors' => 'nullable|string',
        ]);

        // Gestion de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'categorie_id' => $request->categorie_id,
            'image' => $imagePath,
            'colors' => $request->colors
                ? array_map('trim', explode(',', $request->colors))
                : null,
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryPath = $file->store('products/gallery', 'public');

                $product->images()->create([
                    'image_path' => $galleryPath,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès.');
    }
    /**
     * 🔒 Mettre à jour un produit (ADMIN uniquement)
     */

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Produit non trouvé');
        }

        $categories = Category::all(); // Pour la sélection des catégories
        return view('admin.products.edit', compact('product', 'categories'));
    }
    // Mise à jour d'un produit
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'colors' => 'nullable|string',
        ]);
        $colors = $validated['colors']
            ? array_map('trim', explode(',', $validated['colors']))
            : null;

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')->store('products', 'public');
        }

        // Mise à jour des données
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'categorie_id' => $request->categorie_id,
            'colors' => $colors,
            'image' => $product->image,  // assigne la nouvelle image si uploadée
        ]);

        // Enregistrement des nouvelles images de la galerie
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryPath = $file->store('products/gallery', 'public');

                $product->images()->create([
                    'image_path' => $galleryPath,
                ]);
            }
        }


        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }
    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }

    /**
     * 🔒 Supprimer un produit (ADMIN uniquement)
     */
    public function destroy($id)
    {
        // $this->authorize('admin'); // Vérifie que l'utilisateur est admin

        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }

        // Suppression de l'image associée
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès');
    }
}
