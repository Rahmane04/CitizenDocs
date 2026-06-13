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
<div id="app" 
     data-role="{{ auth()->user()?->role }}"
     data-user="{{ json_encode(auth()->user()) }}"
     data-stats="{{ json_encode($stats ?? []) }}">
</div>
@else

<div class="min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-4 lg:gap-6">
                <a href="#" class="flex items-center gap-2 shrink-0">
                    <div class="w-8 h-8 bg-sky-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm font-bold">C</span>
                    </div>
                    <span class="text-slate-800 font-bold text-lg tracking-tight">CitizenDocs</span>
                </a>

                {{-- Menu navigation --}}
                <nav class="flex items-center gap-1">
                    @if(auth()->user()?->role === 'citoyen')
                    <a href="{{ route('citoyen.dashboard') }}"
                    class="whitespace-nowrap px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('citoyen.dashboard') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                     Accueil
                    </a>
                    <a href="{{ route('citoyen.demandes.create') }}"
                    class="whitespace-nowrap px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('citoyen.demandes.create') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                     Nouvelle demande
                    </a>
                    <a href="{{ route('citoyen.demandes.index') }}"
                    class="whitespace-nowrap px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('citoyen.demandes.index') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                     Mes demandes
                    </a>
                    <a href="{{ route('citoyen.paiements.index') }}"
                    class="whitespace-nowrap px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('citoyen.paiements.index') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                     Paiements
                    </a>
                    <a href="{{ route('citoyen.documents.index') }}"
                    class="whitespace-nowrap px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                    {{ request()->routeIs('citoyen.documents.index') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                     Documents
                    </a>
                    @elseif(auth()->user()?->role === 'agent')
                        <a href="{{ route('agent.dashboard') }}"
                           class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                           {{ request()->routeIs('agent.dashboard') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Accueil
                        </a>
                        <a href="{{ route('agent.demandes.index') }}"
                           class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                           {{ request()->routeIs('agent.demandes.*') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801-1.206a2.25 2.25 0 0 0-3.324 0M8.91 2.879a9 9 0 0 1 6.18 0M9.605 6h4.79m-6.79 3.75h10.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5H6.205a1.5 1.5 0 0 1-1.5-1.5v-7.5a1.5 1.5 0 0 1 1.5-1.5Z" />
                            </svg>
                            Demandes
                        </a>
                    @elseif(auth()->user()?->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                           {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Accueil
                        </a>
                        <a href="{{ route('admin.users') }}"
                           class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                           {{ request()->routeIs('admin.users') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766l-.014-.009v-.11a6.375 6.375 0 0112.75 0v.109zM3.557 9a15.047 15.047 0 015.821-1.517 14.98 14.98 0 015.821 1.517M3 13.065a4.125 4.125 0 017.533 0m0 0A4.125 4.125 0 013 13.065zm12.975 0a9.053 9.053 0 00-1.558-4.5M12.01 6a3 3 0 11-6 0 3 3 0 016 0zm7.49 3a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Utilisateurs
                        </a>
                        <a href="{{ route('admin.type_documents') }}"
                           class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                           {{ request()->routeIs('admin.type_documents*') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Types documents
                        </a>
                        <a href="{{ route('admin.rapports') }}"
                           class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                           {{ request()->routeIs('admin.rapports') ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            Rapports
                        </a>
                    @endif
                </nav>
            </div>

            {{-- Profil + déconnexion --}}
            <div class="flex items-center gap-3 ml-8 shrink-0">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-sm shrink-0">
                        {{ auth()->user()?->prenom[0] }}{{ auth()->user()?->nom[0] }}
                    </div>
                    <div class="hidden lg:block shrink-0">
                        <p class="text-sm font-medium text-slate-700 leading-none">{{ auth()->user()?->prenom }} {{ auth()->user()?->nom }}</p>
                        <p class="text-xs text-slate-400 capitalize mt-0.5">{{ auth()->user()?->role }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout" class="ml-2 shrink-0">
                    @csrf
                    <button class="whitespace-nowrap flex items-center gap-1.5 text-sm text-slate-500 hover:text-red-600 transition-all font-semibold px-3 py-2 rounded-xl hover:bg-red-50/80 border border-transparent hover:border-red-100/30">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- CONTENU --}}
    <main class="flex-1 max-w-5xl mx-auto w-full px-6 py-8">
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