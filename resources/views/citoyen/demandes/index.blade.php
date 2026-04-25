@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Mes demandes</h2>
        <a href="{{ route('citoyen.demandes.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Nouvelle demande
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($demandes->isEmpty())
        <p class="text-gray-500">Vous n'avez aucune demande pour le moment.</p>
    @else
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Référence</th>
                        <th class="px-4 py-3 text-left">Type de document</th>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($demandes as $demande)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono font-semibold">{{ $demande->reference }}</td>
                        <td class="px-4 py-3">{{ $demande->typeDocument->nom }}</td>
                        <td class="px-4 py-3">{{ $demande->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            @php
                                $badges = [
                                    'en_attente' => 'bg-yellow-100 text-yellow-700',
                                    'en_cours'   => 'bg-blue-100 text-blue-700',
                                    'validee'    => 'bg-green-100 text-green-700',
                                    'rejetee'    => 'bg-red-100 text-red-700',
                                ];
                                $labels = [
                                    'en_attente' => 'En attente',
                                    'en_cours'   => 'En cours',
                                    'validee'    => 'Validée',
                                    'rejetee'    => 'Rejetée',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badges[$demande->statut] ?? '' }}">
                                {{ $labels[$demande->statut] ?? $demande->statut }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
