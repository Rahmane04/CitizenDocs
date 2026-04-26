@extends('admin.layouts.app')
@section('content')

<h2 class="mb-4">📊 Tableau de bord</h2>

{{-- Cartes statistiques --}}
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-primary text-center p-3 shadow-sm">
            <h2 class="text-primary">{{ $stats['total_users'] }}</h2>
            <p class="text-muted mb-0">👥 Utilisateurs</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-success text-center p-3 shadow-sm">
            <h2 class="text-success">{{ $stats['total_demandes'] }}</h2>
            <p class="text-muted mb-0">📋 Demandes</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-warning text-center p-3 shadow-sm">
            <h2 class="text-warning">{{ number_format($stats['total_paiements'], 0, ',', ' ') }} FCFA</h2>
            <p class="text-muted mb-0">💰 Total paiements</p>
        </div>
    </div>
</div>

{{-- Demandes par statut --}}
<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                📋 Demandes par statut
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Statut</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['demandes_statut'] as $item)
                        <tr>
                            <td>{{ ucfirst($item->statut) }}</td>
                            <td><span class="badge bg-primary">{{ $item->total }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                📄 Demandes par type de document
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['demandes_type'] as $item)
                        <tr>
                            <td>{{ $item->typeDocument->nom ?? 'N/A' }}</td>
                            <td><span class="badge bg-success">{{ $item->total }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection