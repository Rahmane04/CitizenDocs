@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">👥 Gestion des utilisateurs</h1>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b text-gray-500">
                <tr>
                    <th class="py-3 px-4 text-left font-medium">#</th>
                    <th class="py-3 px-4 text-left font-medium">Nom complet</th>
                    <th class="py-3 px-4 text-left font-medium">Email</th>
                    <th class="py-3 px-4 text-left font-medium">Téléphone</th>
                    <th class="py-3 px-4 text-left font-medium">Rôle</th>
                    <th class="py-3 px-4 text-left font-medium">Statut</th>
                    <th class="py-3 px-4 text-left font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-500">{{ $user->id }}</td>
                    <td class="py-3 px-4 font-medium">{{ $user->prenom }} {{ $user->nom }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->telephone }}</td>
                    <td class="py-3 px-4">
                        @php
                            $roleColors = [
                                'admin'   => 'bg-red-100 text-red-700',
                                'agent'   => 'bg-yellow-100 text-yellow-700',
                                'citoyen' => 'bg-blue-100 text-blue-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $roleColors[$user->role] ?? '' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $user->statut === 'actif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ ucfirst($user->statut) }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                            @csrf
                            <button type="submit"
                                class="{{ $user->statut === 'actif' ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-600 hover:bg-green-700' }} text-white px-3 py-1.5 rounded-lg text-xs transition">
                                {{ $user->statut === 'actif' ? '🔒 Désactiver' : '🔓 Activer' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection