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
    </script>
</head>
<body class="bg-gray-50">
    @if(request()->is('citoyen/dashboard') || request()->is('agent/dashboard') || request()->is('admin/dashboard'))
        <div id="app"></div>
    @else
        <div class="min-h-screen flex flex-col">
            <header class="bg-blue-900 text-white px-6 py-3 flex justify-between items-center shadow">
                <span class="text-xl font-bold">🏛️ CitizenDocs</span>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-blue-200">{{ auth()->user()?->prenom }} {{ auth()->user()?->nom }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="bg-white text-blue-900 text-sm font-semibold px-4 py-1.5 rounded hover:bg-gray-100">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </header>

            <div class="flex flex-1">
                <aside class="w-60 bg-blue-800 text-white flex flex-col py-6 px-3">
                    <p class="text-xs text-blue-300 uppercase tracking-widest font-semibold px-3 mb-4">Navigation</p>

                    @if(auth()->user()?->role === 'agent')
                        <a href="{{ route('agent.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('agent.dashboard') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-xs font-bold">A</span>
                            Accueil
                            @if(request()->routeIs('agent.dashboard'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                        <a href="{{ route('agent.demandes.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('agent.demandes.*') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-blue-400 flex items-center justify-center text-xs font-bold">D</span>
                            Demandes
                            @if(request()->routeIs('agent.demandes.*'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>

                    @elseif(auth()->user()?->role === 'citoyen')
                        <a href="{{ route('citoyen.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('citoyen.dashboard') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-xs font-bold">A</span>
                            Accueil
                            @if(request()->routeIs('citoyen.dashboard'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                        <a href="{{ route('citoyen.demandes.create') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('citoyen.demandes.create') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-xs font-bold">N</span>
                            Nouvelle demande
                            @if(request()->routeIs('citoyen.demandes.create'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                        <a href="{{ route('citoyen.demandes.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('citoyen.demandes.index') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-blue-400 flex items-center justify-center text-xs font-bold">M</span>
                            Mes demandes
                            @if(request()->routeIs('citoyen.demandes.index'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>

                    @elseif(auth()->user()?->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-xs font-bold">A</span>
                            Accueil
                            @if(request()->routeIs('admin.dashboard'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                        <a href="{{ route('admin.users') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('admin.users') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-blue-400 flex items-center justify-center text-xs font-bold">U</span>
                            Utilisateurs
                            @if(request()->routeIs('admin.users'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                        <a href="{{ route('admin.type_documents') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('admin.type_documents*') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-xs font-bold">T</span>
                            Types documents
                            @if(request()->routeIs('admin.type_documents*'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                        <a href="{{ route('admin.rapports') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 text-sm
                           {{ request()->routeIs('admin.rapports') ? 'bg-blue-600 font-semibold' : '' }}">
                            <span class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-xs font-bold">R</span>
                            Rapports
                            @if(request()->routeIs('admin.rapports'))<span class="ml-auto w-2 h-2 rounded-full bg-white"></span>@endif
                        </a>
                    @endif

                    <div class="mt-auto px-3 pt-4 border-t border-blue-700">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center font-bold text-sm text-blue-900">
                                {{ auth()->user()?->prenom[0] }}{{ auth()->user()?->nom[0] }}
                            </div>
                            <div>
                                <p class="text-sm font-medium">{{ auth()->user()?->prenom }}</p>
                                <p class="text-xs text-blue-300 capitalize">{{ auth()->user()?->role }}</p>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="flex-1 p-6">
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 border border-green-200 rounded-lg p-4 mb-4 text-sm">
                            ✅ {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-50 text-red-600 border border-red-200 rounded-lg p-4 mb-4 text-sm">
                            ❌ {{ session('error') }}
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    @endif
</body>
</html>