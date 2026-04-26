@extends('agent.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('agent.demandes.index') }}"
           class="btn btn-sm btn-outline-secondary mb-2">← Retour</a>
        <h4 class="fw-bold mb-0">📄 {{ $demande->reference }}</h4>
    </div>
    @switch($demande->statut)
        @case('en_attente')
            <span class="badge bg-warning text-dark fs-6">En attente</span>@break
        @case('en_cours')
            <span class="badge bg-info text-dark fs-6">En cours</span>@break
        @case('validee')
            <span class="badge bg-success fs-6">✅ Validée</span>@break
        @case('rejetee')
            <span class="badge bg-danger fs-6">❌ Rejetée</span>@break
    @endswitch
</div>

<div class="row g-4">

    {{-- Colonne infos --}}
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-semibold">ℹ️ Informations</div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th class="text-muted" width="40%">Référence</th>
                        <td class="fw-semibold text-primary">{{ $demande->reference }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Type document</th>
                        <td>{{ $demande->typeDocument->nom }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Déposée le</th>
                        <td>{{ $demande->created_at->format('d/m/Y à H:i') }}</td>
                    </tr>
                    @if($demande->commentaire)
                    <tr>
                        <th class="text-muted">Commentaire</th>
                        <td>{{ $demande->commentaire }}</td>
                    </tr>
                    @endif
                    @if($demande->agent)
                    <tr>
                        <th class="text-muted">Traité par</th>
                        <td>{{ $demande->agent->name }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header fw-semibold">👤 Citoyen</div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th class="text-muted" width="40%">Nom</th>
                        <td>{{ $demande->citoyen->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Email</th>
                        <td>{{ $demande->citoyen->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Colonne traitement --}}
    <div class="col-md-6">
        @if(in_array($demande->statut, ['validee', 'rejetee']))
            <div class="card shadow-sm border-0 text-white
                {{ $demande->statut === 'validee' ? 'bg-success' : 'bg-danger' }}">
                <div class="card-body text-center py-5">
                    <div style="font-size:3rem">
                        {{ $demande->statut === 'validee' ? '✅' : '❌' }}
                    </div>
                    <h5 class="fw-bold mt-2">
                        Demande {{ $demande->statut === 'validee' ? 'validée' : 'rejetée' }}
                    </h5>
                    <p class="mb-0 opacity-75">Cette demande ne peut plus être modifiée.</p>
                </div>
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-header fw-semibold">⚙️ Traiter la demande</div>
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('agent.demandes.traiter', $demande) }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Décision <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-3">
                                <div class="flex-fill">
                                    <input type="radio" class="btn-check"
                                           name="statut" id="valider" value="validee"
                                           {{ old('statut')==='validee' ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-success w-100" for="valider">
                                        ✅ Valider
                                    </label>
                                </div>
                                <div class="flex-fill">
                                    <input type="radio" class="btn-check"
                                           name="statut" id="rejeter" value="rejetee"
                                           {{ old('statut')==='rejetee' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger w-100" for="rejeter">
                                        ❌ Rejeter
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="commentaire" class="form-label fw-semibold">
                                Commentaire
                                <small class="text-muted fw-normal">(optionnel)</small>
                            </label>
                            <textarea name="commentaire" id="commentaire" rows="4"
                                class="form-control @error('commentaire') is-invalid @enderror"
                                placeholder="Expliquer la décision au citoyen...">{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Confirmer le traitement
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endif
    </div>

</div>

@endsection
