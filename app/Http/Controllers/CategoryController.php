<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function index() { return response()->json(Category::all()); }
    // public function show($id) { return response()->json(Category::findOrFail($id)); }

    // public function store(Request $request) { Category::create($request->all()); }
    // public function update(Request $request, $id) { Category::findOrFail($id)->update($request->all()); }
    // public function destroy($id) { Category::destroy($id); }
    // Affichage des catégories (Admin)
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Formulaire d'ajout d'une catégorie
    public function create()
    {
        return view('admin.categories.create');
    }

    // Ajout d'une nouvelle catégorie
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:555',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    // Formulaire de mise à jour d'une catégorie
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Mise à jour d'une catégorie
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:555',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }
    //suppression d'une catégorie
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimer avec succès.');
    }
}
