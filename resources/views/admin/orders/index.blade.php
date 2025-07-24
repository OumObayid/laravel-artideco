@extends('layouts.admin')

@section('title', 'Commandes')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Liste des Commandes</h2>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Client</th>
                <th>Téléphone</th>
                <th>Produit</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->product->name ?? '-' }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Voir</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette commande ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune commande trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>{{ $orders->links() }}</div>
</div>
@endsection
