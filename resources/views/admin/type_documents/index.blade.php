@extends('admin.layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📄 Types de documents</h2>
    <a href="{{ route('admin.type_documents.create') }}" 
       class="btn btn-primary">
        ➕ Ajouter un type
    </a>
</div>

<table class="table table-hover bg-white shadow-sm rounded">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Délai (jours)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($types as $type)
        <tr>
            <td>{{ $type->id }}</td>
            <td>{{ $type->nom }}</td>
            <td>{{ $type->description ?? '—' }}</td>
            <td>{{ number_format($type->prix, 0, ',', ' ') }} FCFA</td>
            <td>{{ $type->delai_traitement }} j</td>
            <td class="d-flex gap-2">
                <a href="{{ route('admin.type_documents.edit', $type) }}"
                   class="btn btn-sm btn-warning">
                    ✏️ Modifier
                </a>
                <form method="POST"
                      action="{{ route('admin.type_documents.destroy', $type) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Supprimer ce type ?')">
                        🗑️ Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $types->links() }}

@endsection