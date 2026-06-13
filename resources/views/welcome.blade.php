<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CitizenDocs — Gestion de documents administratifs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-sky-600 rounded-xl flex items-center justify-center">
                    <span class="text-white font-black text-sm">C</span>
                </div>
                <span class="font-bold text-slate-800 text-lg">CitizenDocs</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-5 py-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                    Se connecter
                </a>
                <a href="{{ route('register') }}"
                   class="px-5 py-2 bg-sky-600 text-white text-sm font-semibold rounded-xl hover:bg-sky-700 transition">
                    Créer un compte
                </a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="pt-32 pb-20 bg-gradient-to-br from-sky-50 via-white to-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-sky-100 text-sky-700 px-4 py-1.5 rounded-full text-xs font-semibold mb-6">
                        🇸🇳 Service public numérique — Sénégal
                    </div>
                    <h1 class="text-5xl font-black text-slate-900 leading-tight mb-6">
                        Vos documents<br>
                        administratifs<br>
                        <span class="text-sky-600">en quelques clics</span>
                    </h1>
                    <p class="text-slate-500 text-lg leading-relaxed mb-8">
                        CitizenDocs simplifie vos démarches administratives.
                        Demandez, payez et téléchargez vos documents officiels
                        depuis n'importe où, à tout moment.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('register') }}"
                           class="px-7 py-3.5 bg-sky-600 text-white font-bold rounded-2xl hover:bg-sky-700 transition text-sm shadow-lg shadow-sky-200">
                            Commencer gratuitement →
                        </a>
                    </div>
                    <div class="flex items-center gap-6 mt-10">
                        <div class="text-center">
                            <p class="text-2xl font-black text-slate-800">100%</p>
                            <p class="text-xs text-slate-400">En ligne</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-slate-800">24h/24</p>
                            <p class="text-xs text-slate-400">Disponible</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div class="text-center">
                            <p class="text-2xl font-black text-slate-800">Sécurisé</p>
                            <p class="text-xs text-slate-400">Vos données</p>
                        </div>
                    </div>
                </div>

                {{-- Illustration --}}
                <div class="relative">
                    <div class="bg-gradient-to-br from-sky-600 to-sky-800 rounded-3xl p-8 text-white shadow-2xl shadow-sky-200">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <span class="text-2xl">📋</span>
                            </div>
                            <div>
                                <p class="font-bold">Demande en cours</p>
                                <p class="text-sky-200 text-xs">DEM-2026-042</p>
                            </div>
                            <span class="ml-auto bg-amber-400 text-amber-900 text-xs font-bold px-3 py-1 rounded-full">En attente</span>
                        </div>
                        <div class="space-y-3 mb-6">
                            <div class="bg-white/10 rounded-xl p-3 flex justify-between">
                                <span class="text-sky-100 text-sm">Type</span>
                                <span class="font-semibold text-sm">Acte de naissance</span>
                            </div>
                            <div class="bg-white/10 rounded-xl p-3 flex justify-between">
                                <span class="text-sky-100 text-sm">Montant</span>
                                <span class="font-semibold text-sm">1 000 FCFA</span>
                            </div>
                            <div class="bg-white/10 rounded-xl p-3 flex justify-between">
                                <span class="text-sky-100 text-sm">Délai</span>
                                <span class="font-semibold text-sm">3 jours ouvrés</span>
                            </div>
                        </div>
                        <div class="bg-white/20 rounded-xl p-3 flex items-center gap-3">
                            <span class="text-2xl">✅</span>
                            <div>
                                <p class="font-semibold text-sm">Paiement confirmé</p>
                                <p class="text-sky-200 text-xs">Via Wave/OM — WAV-123456</p>
                            </div>
                        </div>
                    </div>

                    {{-- Badge flottant --}}
                </div>
            </div>
        </div>
    </section>

    {{-- COMMENT ÇA MARCHE --}}
    <section id="comment-ca-marche" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-black text-slate-800 mb-4">Comment ça marche ?</h2>
                <p class="text-slate-500">Simple, rapide et sécurisé — en 4 étapes</p>
            </div>
            <div class="grid grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-sky-50 text-sky-600 border border-sky-100 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all duration-300 hover:scale-110 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-sky-600 rounded-full flex items-center justify-center text-white font-black text-sm mx-auto mb-3">1</div>
                    <h3 class="font-bold text-slate-800 mb-2">Créez un compte</h3>
                    <p class="text-slate-500 text-sm">Inscrivez-vous gratuitement avec votre email</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all duration-300 hover:scale-110 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white font-black text-sm mx-auto mb-3">2</div>
                    <h3 class="font-bold text-slate-800 mb-2">Soumettez une demande</h3>
                    <p class="text-slate-500 text-sm">Choisissez le document dont vous avez besoin</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-50 text-orange-500 border border-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all duration-300 hover:scale-110 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white font-black text-sm mx-auto mb-3">3</div>
                    <h3 class="font-bold text-slate-800 mb-2">Payez en ligne</h3>
                    <p class="text-slate-500 text-sm">Wave ou Orange Money acceptés</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-50 text-purple-600 border border-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all duration-300 hover:scale-110 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white font-black text-sm mx-auto mb-3">4</div>
                    <h3 class="font-bold text-slate-800 mb-2">Téléchargez</h3>
                    <p class="text-slate-500 text-sm">Récupérez votre document une fois validé</p>
                </div>
            </div>
        </div>
    </section>

    {{-- DOCUMENTS DISPONIBLES --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-black text-slate-800 mb-4">Documents disponibles</h2>
                <p class="text-slate-500">Tous vos documents administratifs en un seul endroit</p>
            </div>
            <div class="grid grid-cols-4 gap-5">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition hover:border-sky-200">
                    <div class="text-3xl mb-4">🎂</div>
                    <h3 class="font-bold text-slate-800 mb-1">Acte de naissance</h3>
                    <p class="text-slate-500 text-xs mb-4">Document officiel attestant la naissance</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sky-700 font-bold text-sm">1 000 FCFA</span>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2 py-1 rounded-full">3 jours</span>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition hover:border-sky-200">
                    <div class="text-3xl mb-4">🏠</div>
                    <h3 class="font-bold text-slate-800 mb-1">Certificat de résidence</h3>
                    <p class="text-slate-500 text-xs mb-4">Atteste votre lieu de résidence</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sky-700 font-bold text-sm">500 FCFA</span>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2 py-1 rounded-full">2 jours</span>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition hover:border-sky-200">
                    <div class="text-3xl mb-4">⚖️</div>
                    <h3 class="font-bold text-slate-800 mb-1">Casier judiciaire</h3>
                    <p class="text-slate-500 text-xs mb-4">Extrait du casier judiciaire national</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sky-700 font-bold text-sm">2 000 FCFA</span>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2 py-1 rounded-full">5 jours</span>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-md transition hover:border-sky-200">
                    <div class="text-3xl mb-4">🪪</div>
                    <h3 class="font-bold text-slate-800 mb-1">Carte nationale d'identité</h3>
                    <p class="text-slate-500 text-xs mb-4">Pièce d'identité officielle</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sky-700 font-bold text-sm">3 000 FCFA</span>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2 py-1 rounded-full">7 jours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="py-20 bg-sky-600">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black text-white mb-4">
                Prêt à simplifier vos démarches ?
            </h2>
            <p class="text-sky-100 text-lg mb-8">
                Rejoignez CitizenDocs et accédez à vos documents administratifs en ligne
            </p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('register') }}"
                   class="px-8 py-4 bg-white text-sky-700 font-black rounded-2xl hover:bg-sky-50 transition shadow-lg">
                    Créer un compte gratuit
                </a>
                <a href="{{ route('login') }}"
                   class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-2xl hover:bg-white/10 transition">
                    Se connecter
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-sky-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-black text-xs">C</span>
                </div>
                <span class="text-white font-bold">CitizenDocs</span>
            </div>
            <p class="text-slate-400 text-sm">© 2026 CitizenDocs — ESP/UCAD Dakar, Sénégal</p>
        </div>
    </footer>

</body>
</html>