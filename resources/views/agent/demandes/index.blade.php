@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Liste des demandes</h1>

    {{-- Filtres --}}
    <div class="flex gap-2 mb-6">
        <a href="{{ route('agent.demandes.index') }}"
           class="px-4 py-2 rounded-lg text-sm {{ !$statut ? 'bg-blue-800 text-white' : 'border border-gray-300 text-gray-600' }}">
            Toutes
        </a>
        <a href="{{ route('agent.demandes.index', ['statut'=>'en_attente']) }}"
           class="px-4 py-2 rounded-lg text-sm {{ $statut==='en_attente' ? 'bg-yellow-500 text-white' : 'border border-gray-300 text-gray-600' }}">
            En attente
        </a>
        <a href="{{ route('agent.demandes.index', ['statut'=>'validee']) }}"
           class="px-4 py-2 rounded-lg text-sm {{ $statut==='validee' ? 'bg-green-600 text-white' : 'border border-gray-300 text-gray-600' }}">
            Validées
        </a>
        <a href="{{ route('agent.demandes.index', ['statut'=>'rejetee']) }}"
           class="px-4 py-2 rounded-lg text-sm {{ $statut==='rejetee' ? 'bg-red-600 text-white' : 'border border-gray-300 text-gray-600' }}">
            Rejetées
        </a>
    </div>

    {{-- Tableau --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b text-gray-500">
                    <th class="py-3 px-4 text-left font-medium">Référence</th>
                    <th class="py-3 px-4 text-left font-medium">Citoyen</th>
                    <th class="py-3 px-4 text-left font-medium">Type document</th>
                    <th class="py-3 px-4 text-left font-medium">Date</th>
                    <th class="py-3 px-4 text-left font-medium">Statut</th>
                    <th class="py-3 px-4 text-center font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-semibold text-blue-800">{{ $demande->reference }}</td>
                    <td class="py-3 px-4">{{ $demande->citoyen->prenom }} {{ $demande->citoyen->nom }}</td>
                    <td class="py-3 px-4">{{ $demande->typeDocument->nom }}</td>
                    <td class="py-3 px-4 text-gray-500">{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-3 px-4">
                        @switch($demande->statut)
                            @case('en_attente')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">En attente</span>
                                @break
                            @case('validee')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Validée</span>
                                @break
                            @case('rejetee')
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Rejetée</span>
                                @break
                        @endswitch
                    </td>
                    <td class="py-3 px-4 text-center">
                        <a href="{{ route('agent.demandes.show', $demande) }}"
                           class="bg-blue-800 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-900">
                            Voir
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-400 py-8">
                        Aucune demande trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $demandes->links() }}
    </div>
</div>
@endsection