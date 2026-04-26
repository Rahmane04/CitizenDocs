@extends('layouts.app')
@section('content')

<h2 class="mb-4">✏️ Modifier un type de document</h2>

<div class="card shadow-sm p-4 bg-white" style="max-width:600px">
    <form method="POST" 
          action="{{ route('admin.type_documents.update', $typeDocument) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Nom</label>
            <input type="text" name="nom"
                   class="form-control @error('nom') is-invalid @enderror"
                   value="{{ old('nom', $typeDocument->nom) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" rows="3"
                      class="form-control">{{ old('description', $typeDocument->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Prix (FCFA)</label>
            <input type="number" name="prix"
                   class="form-control @error('prix') is-invalid @enderror"
                   value="{{ old('prix', $typeDocument->prix) }}" min="0" required>
            @error('prix')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Délai (jours)</label>
            <input type="number" name="delai_jours"
                   class="form-control @error('delai_jours') is-invalid @enderror"
                   value="{{ old('delai_jours', $typeDocument->delai_jours) }}" 
                   min="1" required>
            @error('delai_jours')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                💾 Mettre à jour
            </button>
            <a href="{{ route('admin.type_documents') }}"
               class="btn btn-secondary">
                ❌ Annuler
            </a>
        </div>
    </form>
</div>

@endsection