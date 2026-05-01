<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs — Vérification</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-blue-900">🏛️ CitizenDocs</h1>
            <p class="text-gray-500 text-sm mt-1">Vérification de votre email</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <p class="text-gray-600 text-sm mb-6 text-center">
            Un code à 6 chiffres a été envoyé à <strong>{{ $email }}</strong>
        </p>

        <form method="POST" action="{{ route('verify.otp.submit') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Code de vérification
                </label>
                <input type="text" name="otp" maxlength="6" required
                    placeholder="000000"
                    class="w-full border border-gray-300 rounded-lg px-3 py-3 text-sm text-center text-2xl tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('otp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition">
                Vérifier mon compte
            </button>

            <p class="text-center text-sm text-gray-500 mt-4">
                <a href="{{ route('register') }}" class="text-blue-700 hover:underline">
                    Retour à l'inscription
                </a>
            </p>
        </form>
    </div>
</body>
</html>