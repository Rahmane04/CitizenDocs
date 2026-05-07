@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <a href="{{ route('citoyen.demandes.index') }}"
           class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
            ← Retour
        </a>
        <h1 class="text-2xl font-bold text-slate-800 mt-2">Paiement</h1>
    </div>

    {{-- Récapitulatif --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-4">
        <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-4">Récapitulatif</h2>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Référence</span>
                <span class="text-sm font-mono font-semibold text-sky-700">{{ $demande->reference }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Type de document</span>
                <span class="text-sm font-medium text-slate-700">{{ $demande->typeDocument->nom }}</span>
            </div>
            <div class="flex justify-between border-t border-slate-100 pt-3 mt-3">
                <span class="text-sm font-semibold text-slate-700">Montant total</span>
                <span class="text-lg font-bold text-sky-700">{{ number_format($demande->typeDocument->prix, 0, ',', ' ') }} FCFA</span>
            </div>
        </div>
    </div>

    {{-- Choix paiement --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-4">Mode de paiement</h2>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 border border-red-200 p-3 rounded-xl mb-4 text-sm">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('citoyen.paiements.store', $demande) }}">
            @csrf

            <div class="grid grid-cols-2 gap-3 mb-6">
                {{-- Wave --}}
                <label class="relative cursor-pointer">
                    <input type="radio" name="methode" value="wave" class="peer sr-only" required>
                    <div class="border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-xl p-4 text-center transition">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-blue-600 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">W</span>
                        </div>
                        <p class="font-semibold text-slate-700 text-sm">Wave</p>
                        <p class="text-xs text-slate-400 mt-0.5">Paiement mobile</p>
                    </div>
                </label>

                {{-- Orange Money --}}
                <label class="relative cursor-pointer">
                    <input type="radio" name="methode" value="orange_money" class="peer sr-only">
                    <div class="border-2 border-slate-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 rounded-xl p-4 text-center transition">
                        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-orange-500 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">OM</span>
                        </div>
                        <p class="font-semibold text-slate-700 text-sm">Orange Money</p>
                        <p class="text-xs text-slate-400 mt-0.5">Paiement mobile</p>
                    </div>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-sky-600 text-white py-3 rounded-xl font-semibold hover:bg-sky-700 transition">
                Confirmer le paiement
            </button>
        </form>
    </div>
</div>
@endsection