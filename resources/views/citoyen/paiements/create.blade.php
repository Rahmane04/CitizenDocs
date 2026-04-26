@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <a href="{{ route('citoyen.demandes.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700">← Retour</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-1">💳 Paiement</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Récapitulatif</h2>
        <table class="w-full text-sm">
            <tr class="border-b">
                <td class="py-2 text-gray-500">Référence</td>
                <td class="py-2 font-semibold text-blue-800">{{ $demande->reference }}</td>
            </tr>
            <tr class="border-b">
                <td class="py-2 text-gray-500">Type document</td>
                <td class="py-2">{{ $demande->typeDocument->nom }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-500">Montant</td>
                <td class="py-2 font-bold text-lg text-blue-800">{{ number_format($demande->typeDocument->prix, 0, ',', ' ') }} FCFA</td>
            </tr>
        </table>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Choisir le mode de paiement</h2>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('citoyen.paiements.store', $demande) }}">
            @csrf

            <div class="flex gap-4 mb-6">
                <label class="flex-1 border-2 border-blue-500 rounded-xl p-4 text-center cursor-pointer hover:bg-blue-50">
                    <input type="radio" name="methode" value="wave" class="mb-2" required>
                    <div class="text-2xl">🌊</div>
                    <div class="font-semibold text-blue-800 mt-1">Wave</div>
                </label>
                <label class="flex-1 border-2 border-orange-500 rounded-xl p-4 text-center cursor-pointer hover:bg-orange-50">
                    <input type="radio" name="methode" value="orange_money" class="mb-2">
                    <div class="text-2xl">🟠</div>
                    <div class="font-semibold text-orange-600 mt-1">Orange Money</div>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition">
                Confirmer le paiement
            </button>
        </form>
    </div>
</div>
@endsection