@extends('admin.layouts.app')
@section('content')

<h2 class="mb-4">📈 Rapports et statistiques</h2>

{{-- Total paiements --}}
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-success text-center p-4 shadow-sm">
            <h2 class="text-success">
                {{ number_format($totalPaiements, 0, ',', ' ') }} FCFA
            </h2>
            <p class="text-muted mb-0">💰 Total des paiements</p>
        </div>
    </div>
</div>

<div class="row g-4">

    {{-- Demandes par statut --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
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
                        @forelse($demandesParStatut as $item)
                        <tr>
                            <td>
                                <span class="badge 
                                    {{ $item->statut === 'validé' ? 'bg-success' : 
                                       ($item->statut === 'rejeté' ? 'bg-danger' : 
                                       ($item->statut === 'en_attente' ? 'bg-warning text-dark' : 'bg-secondary')) }}">
                                    {{ ucfirst($item->statut) }}
                                </span>
                            </td>
                            <td><strong>{{ $item->total }}</strong></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                Aucune donnée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Demandes par type --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
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
                        @forelse($demandesParType as $item)
                        <tr>
                            <td>{{ $item->typeDocument->nom ?? 'N/A' }}</td>
                            <td><strong>{{ $item->total }}</strong></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                Aucune donnée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Paiements par mois --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
                📅 Paiements par mois
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mois</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $mois = ['', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun',
                                 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
                        @endphp
                        @forelse($paiementsParMois as $item)
                        <tr>
                            <td>{{ $mois[$item->mois] }}</td>
                            <td>
                                <strong>
                                    {{ number_format($item->total, 0, ',', ' ') }} FCFA
                                </strong>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                Aucune donnée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection