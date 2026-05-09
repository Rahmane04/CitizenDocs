<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.authUser = @json(auth()->user())
        window.dashboardStats = @json($stats ?? ['en_attente' => 0, 'validee' => 0, 'rejetee' => 0])
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50">

@if(in_array(request()->path(), ['citoyen/dashboard', 'agent/dashboard', 'admin/dashboard']))
<div id="app" data-role="{{ auth()->user()?->role }}" data-user="{{ json_encode(auth()->user()) }}"></div>
@else

<div class="min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="#" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-sky-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">C</span>
                    </div>
                    <span class="text-slate-800 font-bold text-lg tracking-tight">CitizenDocs</span>
                </a>

                {{-- Menu navigation --}}
                <nav class="flex items-center gap-1">
                    @if(auth()->user()?->role === 'citoyen')
                    <a href="{{ route('citoyen.dashboard') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition
                    {{ request()->routeIs('citoyen.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                     Accueil
                    </a>
                    <a href="{{ route('citoyen.demandes.create') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition
                    {{ request()->routeIs('citoyen.demandes.create') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                     Nouvelle demande
                    </a>
                    <a href="{{ route('citoyen.demandes.index') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition
                    {{ request()->routeIs('citoyen.demandes.index') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                     Mes demandes
                    </a>
                    <a href="{{ route('citoyen.paiements.index') }}"class="px-3 py-2 rounded-lg text-sm font-medium transition{{ request()->routeIs('citoyen.paiements.index') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Mes paiements
                    </a>
                    <a href="{{ route('citoyen.documents.index') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition{{ request()->routeIs('citoyen.documents.index') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Mes documents</a>
                         @elseif(auth()->user()?->role === 'agent')
                        <a href="{{ route('agent.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('agent.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Accueil
                        </a>
                        <a href="{{ route('agent.demandes.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('agent.demandes.*') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Demandes
                        </a>

                    @elseif(auth()->user()?->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Accueil
                        </a>
                        <a href="{{ route('admin.users') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('admin.users') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Utilisateurs
                        </a>
                        <a href="{{ route('admin.type_documents') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('admin.type_documents*') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Types documents
                        </a>
                        <a href="{{ route('admin.rapports') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                           {{ request()->routeIs('admin.rapports') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Rapports
                        </a>
                    @endif
                </nav>
            </div>

            {{-- Profil + déconnexion --}}
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-sm">
                        {{ auth()->user()?->prenom[0] }}{{ auth()->user()?->nom[0] }}
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-medium text-slate-700">{{ auth()->user()?->prenom }} {{ auth()->user()?->nom }}</p>
                        <p class="text-xs text-slate-400 capitalize">{{ auth()->user()?->role }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-sm text-slate-500 hover:text-red-600 transition font-medium px-3 py-1.5 rounded-lg hover:bg-red-50">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- CONTENU --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 text-red-600 border border-red-200 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
                <span>❌</span> {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="border-t border-slate-200 bg-white py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <p class="text-xs text-slate-400">© 2026 CitizenDocs — Gestion de documents administratifs</p>
            <p class="text-xs text-slate-400 capitalize">Connecté en tant que <span class="font-medium text-slate-600">{{ auth()->user()?->role }}</span></p>
        </div>
    </footer>

</div>

@endif
</body>
</html>