@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Rapports et statistiques</h1>

    {{-- Total paiements --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border-l-4 border-green-500">
        <p class="text-3xl font-bold text-green-600">{{ number_format($totalPaiements, 0, ',', ' ') }} FCFA</p>
        <p class="text-gray-500 mt-1">💰 Total des paiements</p>
    </div>

    <div class="grid grid-cols-3 gap-5">
        {{-- Demandes par statut --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">📋 Demandes par statut</h2>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="py-2 text-left font-medium">Statut</th>
                        <th class="py-2 text-left font-medium">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandesParStatut as $item)
                    <tr class="border-b">
                        <td class="py-2">
                            @php
                                $colors = [
                                    'en_attente' => 'bg-yellow-100 text-yellow-700',
                                    'validee'    => 'bg-green-100 text-green-700',
                                    'rejetee'    => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $colors[$item->statut] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst(str_replace('_', ' ', $item->statut)) }}
                            </span>
                        </td>
                        <td class="py-2 font-bold">{{ $item->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Demandes par type --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">📄 Par type de document</h2>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="py-2 text-left font-medium">Type</th>
                        <th class="py-2 text-left font-medium">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandesParType as $item)
                    <tr class="border-b">
                        <td class="py-2">{{ $item->nom }}</td>
                        <td class="py-2 font-bold">{{ $item->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paiements par mois --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-base font-semibold text-gray-700 mb-4">📅 Paiements par mois</h2>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="py-2 text-left font-medium">Mois</th>
                        <th class="py-2 text-left font-medium">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiementsParMois as $item)
                    <tr class="border-b">
                        <td class="py-2">{{ $item->mois }}</td>
                        <td class="py-2 font-bold">{{ number_format($item->total, 0, ',', ' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection