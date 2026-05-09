@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Mes documents</h1>

    @if($demandes->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-400">
            Aucun document disponible pour le moment.
        </div>
    @else
        <div class="grid grid-cols-2 gap-4">
            @foreach($demandes as $demande)
            <div class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <p class="font-mono text-sm font-semibold text-sky-700">{{ $demande->reference }}</p>
                        <p class="text-slate-600 text-sm mt-0.5">{{ $demande->typeDocument->nom }}</p>
                    </div>
                    <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full text-xs font-medium">
                        ✅ Validé
                    </span>
                </div>
                <p class="text-xs text-slate-400 mb-4">Validé le {{ $demande->updated_at->format('d/m/Y') }}</p>
                <a href="{{ route('citoyen.documents.download', $demande) }}"
                   class="w-full bg-sky-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-sky-700 transition flex items-center justify-center gap-2">
                    ⬇️ Télécharger
                </a>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection