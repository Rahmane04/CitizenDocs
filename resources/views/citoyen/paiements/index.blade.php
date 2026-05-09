@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Mes paiements</h1>

    @if($paiements->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-400">
            Aucun paiement effectué pour le moment.
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4 text-left font-medium text-slate-500">Référence</th>
                        <th class="py-3 px-4 text-left font-medium text-slate-500">Type document</th>
                        <th class="py-3 px-4 text-left font-medium text-slate-500">Montant</th>
                        <th class="py-3 px-4 text-left font-medium text-slate-500">Méthode</th>
                        <th class="py-3 px-4 text-left font-medium text-slate-500">Statut</th>
                        <th class="py-3 px-4 text-left font-medium text-slate-500">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($paiements as $demande)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-mono font-semibold text-sky-700">{{ $demande->reference }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $demande->typeDocument->nom }}</td>
                        <td class="py-3 px-4 font-semibold text-slate-800">{{ number_format($demande->paiement->montant, 0, ',', ' ') }} FCFA</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $demande->paiement->methode === 'wave' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ $demande->paiement->methode === 'wave' ? '🌊 Wave' : '🟠 Orange Money' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                Confirmé
                            </span>
                        </td>
                        <td class="py-3 px-4 text-slate-500">{{ $demande->paiement->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection