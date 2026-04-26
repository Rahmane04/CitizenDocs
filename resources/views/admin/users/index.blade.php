@extends('admin.layouts.app')
@section('content')

<h2 class="mb-4">👥 Gestion des utilisateurs</h2>

<table class="table table-hover bg-white shadow-sm rounded">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nom complet</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->prenom }} {{ $user->nom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->telephone ?? '—' }}</td>
            <td>
                <span class="badge 
                    {{ $user->role === 'admin' ? 'bg-danger' : 
                       ($user->role === 'agent' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </td>
            <td>
                @if($user->statut === 'actif')
                    <span class="badge bg-success">Actif</span>
                @else
                    <span class="badge bg-danger">Inactif</span>
                @endif
            </td>
            <td>
                <form method="POST"
                      action="{{ route('admin.users.toggle', $user) }}">
                    @csrf
                    <button class="btn btn-sm 
                        {{ $user->statut === 'actif' ? 'btn-warning' : 'btn-success' }}">
                        {{ $user->statut === 'actif' ? '🔒 Désactiver' : '✅ Activer' }}
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    {{ $users->links() }}
</div>

@endsection