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

        <form method="POST" action="{{ route('citoyen.paiements.store', $demande) }}" id="paiementForm">
            @csrf
            <input type="hidden" name="methode" id="methodInput" value="">

            {{-- Options de paiement --}}
            <div class="grid grid-cols-2 gap-4 mb-6">

                {{-- Wave --}}
                <div onclick="selectMethod('wave')"
                     id="wave-card"
                     class="border-2 border-slate-200 rounded-2xl p-5 cursor-pointer hover:border-blue-400 transition text-center">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-blue-600 flex items-center justify-center">
                        <span class="text-white font-black text-2xl">W</span>
                    </div>
                    <p class="font-bold text-slate-700 mb-1">Wave</p>
                    <p class="text-xs text-slate-400 mb-3">Scannez le QR code</p>
                    {{-- QR Code Wave --}}
                    <div id="qr-wave" class="hidden">
                        <div class="bg-white p-2 rounded-xl border border-slate-200 inline-block mb-2">
                            <canvas id="canvas-wave"></canvas>
                        </div>
                        <p class="text-xs text-blue-600 font-medium">+221 77 XXX XX XX</p>
                    </div>
                </div>

                {{-- Orange Money --}}
                <div onclick="selectMethod('orange_money')"
                     id="om-card"
                     class="border-2 border-slate-200 rounded-2xl p-5 cursor-pointer hover:border-orange-400 transition text-center">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-orange-500 flex items-center justify-center">
                        <span class="text-white font-black text-lg">OM</span>
                    </div>
                    <p class="font-bold text-slate-700 mb-1">Orange Money</p>
                    <p class="text-xs text-slate-400 mb-3">Scannez le QR code</p>
                    {{-- QR Code OM --}}
                    <div id="qr-om" class="hidden">
                        <div class="bg-white p-2 rounded-xl border border-slate-200 inline-block mb-2">
                            <canvas id="canvas-om"></canvas>
                        </div>
                        <p class="text-xs text-orange-600 font-medium">+221 77 XXX XX XX</p>
                    </div>
                </div>
            </div>

            {{-- Message instruction --}}
            <div id="instruction" class="hidden bg-sky-50 border border-sky-200 rounded-xl p-4 mb-4 text-sm text-sky-700 text-center">
                📱 Scannez le QR code avec votre application, puis confirmez ci-dessous
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-slate-300 text-slate-500 py-3 rounded-xl font-semibold transition cursor-not-allowed"
                disabled>
                Sélectionnez un mode de paiement
            </button>
        </form>
    </div>
</div>

{{-- QR Code library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
let selectedMethod = null

function selectMethod(method) {
    selectedMethod = method
    document.getElementById('methodInput').value = method

    // Reset cards
    document.getElementById('wave-card').classList.remove('border-blue-500', 'bg-blue-50')
    document.getElementById('om-card').classList.remove('border-orange-500', 'bg-orange-50')
    document.getElementById('qr-wave').classList.add('hidden')
    document.getElementById('qr-om').classList.add('hidden')

    if (method === 'wave') {
        document.getElementById('wave-card').classList.add('border-blue-500', 'bg-blue-50')
        document.getElementById('qr-wave').classList.remove('hidden')

        // Générer QR Wave
        document.getElementById('canvas-wave').innerHTML = ''
        new QRCode(document.getElementById('canvas-wave'), {
            text: 'wave://pay?phone=+22177000000&amount={{ $demande->typeDocument->prix }}&ref={{ $demande->reference }}',
            width: 120,
            height: 120,
            colorDark: '#1d4ed8',
            colorLight: '#ffffff',
        })
    } else {
        document.getElementById('om-card').classList.add('border-orange-500', 'bg-orange-50')
        document.getElementById('qr-om').classList.remove('hidden')

        // Générer QR Orange Money
        document.getElementById('canvas-om').innerHTML = ''
        new QRCode(document.getElementById('canvas-om'), {
            text: 'orangemoney://pay?phone=+22177000000&amount={{ $demande->typeDocument->prix }}&ref={{ $demande->reference }}',
            width: 120,
            height: 120,
            colorDark: '#ea580c',
            colorLight: '#ffffff',
        })
    }

    // Activer bouton
    document.getElementById('instruction').classList.remove('hidden')
    const btn = document.getElementById('submitBtn')
    btn.disabled = false
    btn.classList.remove('bg-slate-300', 'text-slate-500', 'cursor-not-allowed')
    btn.classList.add('bg-sky-600', 'text-white', 'hover:bg-sky-700', 'cursor-pointer')
    btn.textContent = 'Confirmer le paiement'
}
</script>
@endsection