@extends('layouts.app')

@section('content')
    {{-- 🔹 BANNIÈRE --}}
    <div class="banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1 class="display-4 fw-bold">Votre intérieur, votre style</h1>
            <p class="lead">Découvrez nos tables, tabourets et décorations élégantes</p>
            <a href="#produits" class="btn btn-custom btn-lg mt-3">Voir les produits</a>
        </div>
    </div>


    {{-- 🔹 PRODUITS --}}
    <section id="produits" class="product-section">
        <div class="container">
            <h2 class="text-center mb-5">Nos Produits</h2>
            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card cardd h-100">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="cardd-img-top"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=Aucune+image" class="cardd-img-top"
                                    alt="Pas d'image">
                            @endif

                            <div class="cardd-body d-flex flex-column justify-content-between text-center">
                                <div>
                                    <h6 class="cardd-title text-truncate mx-2" title="{{ $product->name }}">
                                        {{ $product->name }}</h6>
                                </div>
                                <div class="mt-auto">
                                    <p class="fw-bold mb-2">{{ number_format($product->price, 2, ',', ' ') }} dh</p>
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-custom w-100 mb-1">Voir détails</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Aucun produit disponible pour le moment.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('styles')
   
@endpush
