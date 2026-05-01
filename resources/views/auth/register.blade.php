<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs — Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-blue-900">🏛️ CitizenDocs</h1>
            <p class="text-gray-500 text-sm mt-1">Créer un compte citoyen</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('prenom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition">
                Créer mon compte
            </button>

            <p class="text-center text-sm text-gray-500 mt-4">
                Déjà inscrit ?
                <a href="{{ route('login') }}" class="text-blue-700 hover:underline">Se connecter</a>
            </p>
        </form>
    </div>
</body>
</html>