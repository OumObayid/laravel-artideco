@extends('layouts.admin')

@section('content')
    <div class="container py-4" >
        <div class="card shadow-sm border-0">
            <div class="card-header text-center text-white" style="background-color: #1c1f1f;">
                <h3><i class="bi bi-plus-circle"></i> Ajouter un Produit</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nom du produit</label>
                        <input type="text" class="form-control border-2 " id="name" name="name" required
                            placeholder="Entrez le nom du produit">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control border-2 " id="description" name="description" rows="4"
                            placeholder="Description détaillée du produit"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Prix (dh)</label>
                        <input type="number" step="0.01" class="form-control border-2 " id="price" name="price"
                            required placeholder="Exemple: 19.99">
                    </div>

                    <div class="mb-3">
                        <label for="categorie_id" class="form-label fw-semibold">Catégorie</label>
                        <select class="form-select border-2 " id="categorie_id" name="categorie_id" required>
                            <option value="" disabled selected>Sélectionner une catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="colors" class="form-label fw-semibold">Couleurs disponibles</label>
                        <input type="text" class="form-control border-2" id="colors" name="colors"
                            placeholder="Ex : rouge, bleu, noir">
                        <div class="form-text">Séparez les couleurs par une virgule (si plusieurs).</div>
                    </div>


                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">Image du produit</label>
                        <input type="file" class="form-control border-2 " id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-4">
                        <label for="gallery_images" class="form-label fw-semibold">Galerie (images supplémentaires)</label>
                        <input type="file" class="form-control border-2" id="gallery_images" name="gallery_images[]"
                            accept="image/*" multiple>
                        <div class="form-text">Vous pouvez sélectionner plusieurs images pour la galerie.</div>
                    </div>


                    <div class="d-flex justify-content-end ">
                        <button type="submit" class="btn btn-dark px-5 py-2 fw-semibold">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
