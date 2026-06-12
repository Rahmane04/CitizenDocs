<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs — Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen">

        {{-- Gauche -- Formulaire --}}
        <div class="w-full lg:w-1/2 bg-slate-900 flex flex-col justify-center px-10 py-12">
            <div class="max-w-md mx-auto w-full">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-sky-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-black text-lg">C</span>
                    </div>
                    <span class="text-white font-bold text-xl">CitizenDocs</span>
                </div>

                <h1 class="text-3xl font-extrabold text-white mb-2">Créer un compte</h1>
                <p class="text-slate-400 text-sm mb-8">Rejoignez CitizenDocs pour gérer vos documents administratifs</p>

                @if($errors->any())
                    <div class="bg-red-500/20 border border-red-500 text-red-300 p-3 rounded-xl mb-4 text-sm">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-300 text-sm font-medium mb-1.5">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" required
                                placeholder="Votre prénom"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-slate-300 text-sm font-medium mb-1.5">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" required
                                placeholder="Votre nom"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-300 text-sm font-medium mb-1.5">Adresse email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="exemple@email.com"
                            class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                    </div>

                    <div>
                        <label class="block text-slate-300 text-sm font-medium mb-1.5">Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone') }}"
                            placeholder="+221 XX XXX XX XX"
                            class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-300 text-sm font-medium mb-1.5">Mot de passe</label>
                            <input type="password" name="password" required
                                placeholder="••••••••"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-slate-300 text-sm font-medium mb-1.5">Confirmer</label>
                            <input type="password" name="password_confirmation" required
                                placeholder="••••••••"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-sky-600 text-white py-3 rounded-xl font-bold hover:bg-sky-700 transition text-sm mt-2">
                        Créer mon compte →
                    </button>
                </form>

                <p class="text-center text-slate-400 text-sm mt-6">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}" class="text-sky-400 font-semibold hover:underline">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>

        {{-- Droite --}}
        <div class="hidden lg:flex w-1/2 bg-sky-700 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-sky-600 via-sky-700 to-sky-900"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-10 right-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 left-10 w-96 h-96 bg-sky-300 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 flex flex-col justify-center px-14 py-12">
                <h2 class="text-4xl font-extrabold text-white mb-4 leading-tight">
                    Rejoignez<br>
                    <span class="text-sky-200">CitizenDocs</span>
                </h2>
                <p class="text-sky-100 text-sm leading-relaxed mb-10">
                    Créez votre compte gratuitement et accédez à tous vos
                    documents administratifs en ligne depuis n'importe où.
                </p>

                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center text-white text-xs font-bold">1</span>
                        <p class="text-sky-100 text-sm">Créez votre compte en 2 minutes</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center text-white text-xs font-bold">2</span>
                        <p class="text-sky-100 text-sm">Vérifiez votre email avec le code OTP</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center text-white text-xs font-bold">3</span>
                        <p class="text-sky-100 text-sm">Soumettez vos premières demandes</p>
                    </div>
                </div>

                <p class="text-sky-300 text-xs mt-12">© 2026 CitizenDocs — ESP/UCAD Dakar, Sénégal</p>
            </div>
        </div>

    </div>
</body>
</html>