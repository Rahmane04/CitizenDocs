<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs — Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-sky-600 rounded-xl flex items-center justify-center mx-auto mb-3">
                <span class="text-white font-bold text-xl">C</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">CitizenDocs</h1>
            <p class="text-slate-500 text-sm mt-1">Gestion de documents administratifs</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-8">
            <h2 class="text-lg font-semibold text-slate-800 mb-6">Connexion à votre compte</h2>

            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-700 border border-emerald-200 p-3 rounded-xl mb-4 text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 text-red-600 border border-red-200 p-3 rounded-xl mb-4 text-sm">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Adresse email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="text-sm font-medium text-slate-700">Mot de passe</label>
                    </div>
                    <input type="password" name="password" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition">
                </div>

                <button type="submit"
                    class="w-full bg-sky-600 text-white py-2.5 rounded-xl font-semibold hover:bg-sky-700 transition text-sm">
                    Se connecter
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-sky-600 font-medium hover:underline">
                    Créer un compte
                </a>
            </p>
        </div>

        <p class="text-center text-xs text-slate-400 mt-6">
            © 2026 CitizenDocs — Tous droits réservés
        </p>
    </div>
</body>
</html>