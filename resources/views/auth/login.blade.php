<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs — Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen">

        {{-- Gauche -- Formulaire --}}
        <div class="w-full lg:w-1/2 bg-sky-700 flex flex-col justify-center px-10 py-12">
            <div class="max-w-md mx-auto w-full">
                {{-- Logo --}}
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                        <span class="text-sky-700 font-black text-lg">C</span>
                    </div>
                    <span class="text-white font-bold text-xl">CitizenDocs</span>
                </div>

                <h1 class="text-3xl font-extrabold text-white mb-2">Bienvenue !</h1>
                <p class="text-sky-200 text-sm mb-8">Connectez-vous pour accéder à vos documents administratifs</p>

                @if(session('success'))
                    <div class="bg-emerald-500 text-white p-3 rounded-xl mb-4 text-sm">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-500 text-white p-3 rounded-xl mb-4 text-sm">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sky-100 text-sm font-medium mb-1.5">Adresse email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="exemple@email.com"
                            class="w-full bg-sky-600 border border-sky-500 text-white placeholder-sky-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-white transition">
                    </div>

                    <div>
                        <label class="block text-sky-100 text-sm font-medium mb-1.5">Mot de passe</label>
                        <input type="password" name="password" required
                            placeholder="••••••••"
                            class="w-full bg-sky-600 border border-sky-500 text-white placeholder-sky-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-white transition">
                    </div>

                    <button type="submit"
                        class="w-full bg-white text-sky-700 py-3 rounded-xl font-bold hover:bg-sky-50 transition text-sm mt-2">
                        Se connecter →
                    </button>
                </form>

                <p class="text-center text-sky-200 text-sm mt-6">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-white font-semibold hover:underline">
                        Créer un compte
                    </a>
                </p>
            </div>
        </div>

        {{-- Droite -- Présentation --}}
        <div class="hidden lg:flex w-1/2 bg-slate-900 relative overflow-hidden">
            {{-- Fond avec gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-sky-900 via-slate-800 to-slate-900"></div>

            {{-- Pattern décoratif --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-20 w-64 h-64 bg-sky-400 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-80 h-80 bg-blue-500 rounded-full blur-3xl"></div>
            </div>

            {{-- Contenu --}}
            <div class="relative z-10 flex flex-col justify-center px-14 py-12">
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-8 mb-8">
                    <h2 class="text-3xl font-extrabold text-white mb-4">
                        Vos documents administratifs<br>
                        <span class="text-sky-400">en quelques clics</span>
                    </h2>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        CitizenDocs simplifie vos démarches administratives.
                        Soumettez vos demandes, effectuez vos paiements et
                        téléchargez vos documents depuis chez vous.
                    </p>
                </div>

                {{-- Features --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-white/5 rounded-xl p-4">
                        <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center shrink-0">
                            <span class="text-white text-lg">📄</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">Demandes en ligne</p>
                            <p class="text-slate-400 text-xs">Soumettez vos demandes 24h/24</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white/5 rounded-xl p-4">
                        <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center shrink-0">
                            <span class="text-white text-lg">💳</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">Paiement sécurisé</p>
                            <p class="text-slate-400 text-xs">Wave & Orange Money acceptés</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white/5 rounded-xl p-4">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center shrink-0">
                            <span class="text-white text-lg">⬇️</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">Téléchargement immédiat</p>
                            <p class="text-slate-400 text-xs">Documents disponibles après validation</p>
                        </div>
                    </div>
                </div>

                <p class="text-slate-500 text-xs mt-8">© 2026 CitizenDocs — ESP/UCAD Dakar, Sénégal</p>
            </div>
        </div>

    </div>
</body>
</html>