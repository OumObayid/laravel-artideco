@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Bienvenue Admin</h2>

        <div class="row">
            {{-- Produits --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-info p-3">
                    <span class="info-box-icon"><i class="fas fa-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Produits</span>
                        <span class="info-box-number">{{$productCount}}</span>
                        <a href="{{route('admin.products.index')}}" class="small-box-footer text-white">Gérer <i class="gestIcon fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Catégories --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-success p-3">
                    <span class="info-box-icon"><i class="fas fa-tags"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Catégories</span>
                        <span class="info-box-number">{{$categoryCount}}</span>
                        <a href="{{route('admin.categories.index')}}" class="small-box-footer text-white">Gérer <i class="gestIcon fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Commandes --}}
            <div class="col-md-3 col-sm-6 col-12 ">
                <div class="info-box bg-warning p-3">
                    <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-white">Commandes</span>
                        <span class="info-box-number text-white">{{$orderCount}}</span>
                        <a href="{{route('admin.orders.index')}}" class="small-box-footer text-white">Voir <i class="gestIcon fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Utilisateurs (optionnel) --}}
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-danger p-3">
                    <span class="info-box-icon"><i class="fas fa-user-shield"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Utilisateurs</span>
                        <span class="info-box-number ">{{$userCount}}</span>
                        <a href="{{route('admin.users.index')}}" class=" small-box-footer text-white">Gérer <i class="gestIcon fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Dernières commandes --}}
<div class="card mt-5">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"> Dernières commandes</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Produit</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestOrders as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->product->name ?? '-' }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucune commande récente</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
