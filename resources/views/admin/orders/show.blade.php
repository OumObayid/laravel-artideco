@extends('layouts.admin')

@section('title', 'Détail de la commande')

@section('content')
<div class="container">
    <h2>Détail de la commande</h2>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Client :</strong> {{ $order->name }}</li>
        <li class="list-group-item"><strong>Téléphone :</strong> {{ $order->phone }}</li>
        <li class="list-group-item"><strong>Ville :</strong> {{ $order->city }}</li>
        <li class="list-group-item"><strong>Adresse :</strong> {{ $order->address }}</li>
        <li class="list-group-item"><strong>Produit :</strong> {{ $order->product->name ?? '-' }}</li>
        <li class="list-group-item"><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">⬅ Retour</a>
</div>
@endsection
