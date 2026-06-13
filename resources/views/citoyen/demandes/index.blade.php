@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Mes demandes</h2>
        <a href="{{ route('citoyen.demandes.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-sky-600 text-white text-sm font-semibold rounded-xl hover:bg-sky-700 active:scale-95 transition-all shadow-md shadow-sky-200 border border-sky-600 hover:shadow-lg">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Nouvelle demande
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-600 border border-red-200 p-3 rounded-lg mb-4 text-sm">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if($demandes->isEmpty())
        <div class="bg-white rounded-xl shadow-sm p-8 text-center text-gray-400">
            Vous n'avez aucune demande pour le moment.
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b text-gray-500">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">Référence</th>
                        <th class="px-4 py-3 text-left font-medium">Type de document</th>
                        <th class="px-4 py-3 text-left font-medium">Date</th>
                        <th class="px-4 py-3 text-left font-medium">Statut</th>
                        <th class="px-4 py-3 text-left font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($demandes as $demande)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono font-semibold text-blue-800">
                            {{ $demande->reference }}
                        </td>
                        <td class="px-4 py-3">{{ $demande->typeDocument->nom }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $demande->created_at->format('d/m/Y') }}</td>
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
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                {{-- Bouton Payer si pas encore payé --}}
                                @if(!$demande->paiement)
                                    <a href="{{ route('citoyen.paiements.create', $demande) }}"
                                       class="inline-flex items-center justify-center bg-orange-500 text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-orange-600 active:scale-95 transition-all shadow-sm shadow-orange-100">
                                        Payer
                                    </a>
                                @endif

                                {{-- Bouton Télécharger si validée --}}
                                @if($demande->statut === 'validee')
                                    <a href="{{ route('citoyen.documents.download', $demande) }}"
                                       class="inline-flex items-center justify-center bg-emerald-600 text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-emerald-700 active:scale-95 transition-all shadow-sm shadow-green-100">
                                        Télécharger
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection