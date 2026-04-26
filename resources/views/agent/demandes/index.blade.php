@extends('agent.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">📋steon esd demandes</h4>
    <span class="text-muted">Connecté : {{ Auth::user()->name }}</span>
</div>

{{-- Filtres --}}
<div class="card shadow-sm mb-4">
    <div class="card-body py-2">
        <div class="d-flex gap-2 flex-wrap">
            <span class="fw-semibold me-2 align-self-center">Filtrer :</span>
            <a href="{{ route('agent.demandes.index') }}"
               class="btn btn-sm {{ !$statut ? 'btn-primary' : 'btn-outline-primary' }}">
               Toutes
            </a>
            <a href="{{ route('agent.demandes.index', ['statut'=>'en_attente']) }}"
               class="btn btn-sm {{ $statut==='en_attente' ? 'btn-warning' : 'btn-outline-warning' }}">
               En attente
            </a>
            <a href="{{ route('agent.demandes.index', ['statut'=>'en_cours']) }}"
               class="btn btn-sm {{ $statut==='en_cours' ? 'btn-info' : 'btn-outline-info' }}">
               En cours
            </a>
            <a href="{{ route('agent.demandes.index', ['statut'=>'validee']) }}"
               class="btn btn-sm {{ $statut==='validee' ? 'btn-success' : 'btn-outline-success' }}">
               Validées
            </a>
            <a href="{{ route('agent.demandes.index', ['statut'=>'rejetee']) }}"
               class="btn btn-sm {{ $statut==='rejetee' ? 'btn-danger' : 'btn-outline-danger' }}">
               Rejetées
            </a>
        </div>
    </div>
</div>

{{-- Tableau --}}
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Référence</th>
                    <th>Citoyen</th>
                    <th>Type de document</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                <tr>
                    <td class="fw-semibold text-primary">{{ $demande->reference }}</td>
                    <td>{{ $demande->citoyen->name }}</td>
                    <td>{{ $demande->typeDocument->nom }}</td>
                    <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @switch($demande->statut)
                            @case('en_attente')
                                <span class="badge bg-warning text-dark">En attente</span>
                                @break
                            @case('en_cours')
                                <span class="badge bg-info text-dark">En cours</span>
                                @break
                            @case('validee')
                                <span class="badge bg-success">Validée</span>
                                @break
                            @case('rejetee')
                                <span class="badge bg-danger">Rejetée</span>
                                @break
                        @endswitch
                    </td>
                    <td class="text-center">
                        <a href="{{ route('agent.demandes.show', $demande) }}"
                           class="btn btn-sm btn-outline-primary">
                            👁️ Voir
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Aucune demande trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $demandes->appends(['statut' => $statut])->links() }}
</div>

@endsection
