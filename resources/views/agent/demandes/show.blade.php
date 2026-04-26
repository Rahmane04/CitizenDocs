@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('agent.demandes.index') }}"
               class="text-sm text-gray-500 hover:text-gray-700">← Retour</a>
            <h1 class="text-2xl font-bold text-gray-800 mt-1">📄 {{ $demande->reference }}</h1>
        </div>
        @switch($demande->statut)
            @case('en_attente')
                <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-sm font-medium">En attente</span>@break
            @case('validee')
                <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-sm font-medium">✅ Validée</span>@break
            @case('rejetee')
                <span class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-sm font-medium">❌ Rejetée</span>@break
        @endswitch
    </div>

    <div class="grid grid-cols-2 gap-6">

        {{-- Infos demande --}}
        <div class="flex flex-col gap-4">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-base font-semibold text-gray-700 mb-4">ℹ️ Informations</h2>
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <td class="py-2 text-gray-500 w-40">Référence</td>
                        <td class="py-2 font-semibold text-blue-800">{{ $demande->reference }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">Type document</td>
                        <td class="py-2">{{ $demande->typeDocument->nom }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">Déposée le</td>
                        <td class="py-2">{{ $demande->created_at->format('d/m/Y à H:i') }}</td>
                    </tr>
                    @if($demande->commentaire)
                    <tr class="border-b">
                        <td class="py-2 text-gray-500">Commentaire</td>
                        <td class="py-2">{{ $demande->commentaire }}</td>
                    </tr>
                    @endif
                    @if($demande->agent)
                    <tr>
                        <td class="py-2 text-gray-500">Traité par</td>
                        <td class="py-2">{{ $demande->agent->prenom }} {{ $demande->agent->nom }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-base font-semibold text-gray-700 mb-4">👤 Citoyen</h2>
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <td class="py-2 text-gray-500 w-40">Nom</td>
                        <td class="py-2">{{ $demande->citoyen->prenom }} {{ $demande->citoyen->nom }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-500">Email</td>
                        <td class="py-2">{{ $demande->citoyen->email }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Traitement --}}
        <div>
            @if(in_array($demande->statut, ['validee', 'rejetee']))
                <div class="rounded-xl p-8 text-center text-white
                    {{ $demande->statut === 'validee' ? 'bg-green-600' : 'bg-red-600' }}">
                    <div class="text-5xl mb-3">
                        {{ $demande->statut === 'validee' ? '✅' : '❌' }}
                    </div>
                    <h2 class="text-xl font-bold">
                        Demande {{ $demande->statut === 'validee' ? 'validée' : 'rejetée' }}
                    </h2>
                    <p class="text-sm opacity-75 mt-1">Cette demande ne peut plus être modifiée.</p>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-base font-semibold text-gray-700 mb-4">⚙️ Traiter la demande</h2>

                    @if($errors->any())
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('agent.demandes.traiter', $demande) }}">
                        @csrf

                        <div class="mb-4">
                            <label class="text-sm font-semibold text-gray-700 mb-2 block">
                                Décision <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-3">
                                <label class="flex-1 border-2 border-green-500 rounded-lg p-3 text-center cursor-pointer hover:bg-green-50">
                                    <input type="radio" name="statut" value="validee" class="mr-1"
                                        {{ old('statut')==='validee' ? 'checked' : '' }} required>
                                    ✅ Valider
                                </label>
                                <label class="flex-1 border-2 border-red-500 rounded-lg p-3 text-center cursor-pointer hover:bg-red-50">
                                    <input type="radio" name="statut" value="rejetee" class="mr-1"
                                        {{ old('statut')==='rejetee' ? 'checked' : '' }}>
                                    ❌ Rejeter
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="text-sm font-semibold text-gray-700 mb-2 block">
                                Commentaire <span class="text-gray-400 font-normal">(optionnel)</span>
                            </label>
                            <textarea name="commentaire" rows="4"
                                class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Expliquer la décision au citoyen...">{{ old('commentaire') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition">
                            Confirmer le traitement
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection