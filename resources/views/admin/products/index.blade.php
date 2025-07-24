@extends('layouts.admin')

@section('content')
    <div class="container-fluid ">
        <div class="card shadow-sm border-0" >

            {{-- Bouton Ajouter --}}
            <div class="d-flex justify-content-between align-item-center  m-3">
                <h3>Liste des Produits</h3>
                <a href="{{ route('admin.products.create') }}" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> Ajouter un produit
                </a>
            </div>
            {{-- Message de succès --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            {{-- Tableau des produits --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix (dh)</th>
                            <th>Catégorie</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" width="50"
                                            class="rounded shadow-sm" alt="image">
                                    @else
                                        <span class="text-muted">Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 60) }}</td>
                                <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
                                <td>{{ $product->category->name ?? 'Non classé' }}</td>
                                <td class=" ">
                                    <div class="d-flex justify-content-between gap-2">

                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-warning mx-2">
                                            <i class="fas fa-pencil-square"></i> 
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ">
                                                <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun produit disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
