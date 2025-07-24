@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row g-4 align-items-start">
            {{--  Image --}}
            <div class="col-md-6">
                <div class="p-3 rounded shadow" style="background-color: #1d1b19;">
                    {{-- <div class="border rounded overflow-hidden" style="cursor: zoom-in;">
                        <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100"
                            style="transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'"
                            onmouseout="this.style.transform='scale(1)'">
                    </div> --}}
                    <div class="border rounded overflow-hidden" style="cursor: zoom-in;" data-bs-toggle="modal"
                        data-bs-target="#zoomModal">
                        <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100"
                            style="transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.2)'"
                            onmouseout="this.style.transform='scale(1)'">
                    </div>


                    @if ($product->images && $product->images->count())
                        <div class="d-flex gap-2 mt-3">
                            @foreach ($product->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" onclick="changeImage(this.src)"
                                    style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                    class="border rounded p-1 bg-white">
                            @endforeach
                        </div>
                    @endif

                    {{-- Modal Bootstrap pour zoom plein écran --}}
                    <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-dark border-0">
                                <div class="modal-body text-center p-0">
                                    <img id="zoomedImage" src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{--  Détails + Formulaire --}}
            <div class="col-md-6">
                <h2 class="fw-bold text-light mb-3">{{ $product->name }}</h2>
                <p class="text-secondary">{{ $product->category->name ?? 'Non classé' }}</p>
                <p class="mb-4 text-light">{{ $product->description }}</p>
                <h4 class="fw-bold text-warning mb-4">{{ number_format($product->price, 2, ',', ' ') }} DH</h4>

                {{--  Formulaire de commande --}}
                <div class="card border-0 shadow" style="background-color: #2a2622; color: #fff;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 text-light">Commander ce produit</h5>

                        <form action="{{ route('order.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Couleur (si dispo) --}}
                            @if ($product->colors)
                                @php
                                    $colors = $product->colors;
                                @endphp
                                <div class="mb-3">
                                    <label class="form-label text-light">Choisir une couleur</label>
                                    <select name="color" class="form-select bg-dark text-light border-secondary" required>
                                        <option value="" disabled selected>-- Sélectionner --</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ trim($color) }}">{{ ucfirst(trim($color)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            {{-- Quantité avec boutons + / - --}}
                            <div class="mb-3">
                                <label class="form-label text-light">Quantité</label>
                                <div class="d-flex align-items-center bg-dark rounded px-2" style="width: fit-content;">
                                    <button type="button" class="btn btn-outline-light btn-sm px-3 fw-bold quantity-btn"
                                        aria-label="Moins">−</button>

                                    <input type="number" name="quantity" min="1" value="1"
                                        class="form-control bg-dark text-light text-center border-0 shadow-none quantity-input"
                                        style="width: 60px;" required>

                                    <button type="button" class="btn btn-outline-light btn-sm px-3 fw-bold quantity-btn"
                                        aria-label="Plus">+</button>
                                </div>
                            </div>

                            {{-- Infos client --}}
                            <div class="mb-3">
                                <label class="form-label text-light">Nom complet</label>
                                <input type="text" name="name"
                                    class="form-control bg-dark text-light border-secondary" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light">Téléphone</label>
                                <input type="tel" name="phone"
                                    class="form-control bg-dark text-light border-secondary" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light">Ville</label>
                                <input type="text" name="city"
                                    class="form-control bg-dark text-light border-secondary" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-light">Adresse complète</label>
                                <textarea name="address" rows="3" class="form-control bg-dark text-light border-secondary" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-custom w-100">Commander maintenant</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script JS pour gérer les boutons + / - quantité --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.closest('.d-flex').querySelector('.quantity-input');
                    let value = parseInt(input.value) || 1;

                    if (this.textContent.trim() === '+') {
                        input.value = value + 1;
                    } else if (this.textContent.trim() === '−' && value > 1) {
                        input.value = value - 1;
                    }
                });
            });
        });
    </script>
    <script>
        function changeImage(src) {
            const mainImage = document.getElementById('mainImage');
            const zoomedImage = document.getElementById('zoomedImage');

            mainImage.src = src;
            zoomedImage.src = src;
        }
    </script>

@endsection


<style>
    /* Supprimer les flèches sur input type=number dans Chrome, Safari, Edge */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Supprimer les flèches dans Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
