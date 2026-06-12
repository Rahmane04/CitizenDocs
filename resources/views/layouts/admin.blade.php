<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CitizenDocs — Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-10">
        <div class="p-6 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-sky-600 rounded-xl flex items-center justify-center">
                    <span class="text-white font-black text-sm">C</span>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-sm">CitizenDocs</p>
                    <p class="text-xs text-slate-400">Panel Admin</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:bg-slate-50' }}">
                <span class="text-lg">📊</span> Dashboard
            </a>
            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.users') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:bg-slate-50' }}">
                <span class="text-lg">👥</span> Utilisateurs
            </a>
            <a href="{{ route('admin.type_documents') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.type_documents*') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:bg-slate-50' }}">
                <span class="text-lg">📄</span> Types documents
            </a>
            <a href="{{ route('admin.rapports') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.rapports') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:bg-slate-50' }}">
                <span class="text-lg">📈</span> Rapports
            </a>
            <a href="{{ route('admin.agents.create') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.agents.create') ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:bg-slate-50' }}">
                <span class="text-lg">➕</span> Ajouter agent
            </a>
        </nav>

        <div class="p-4 border-t border-slate-200">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-sm">
                    {{ auth()->user()?->prenom[0] }}{{ auth()->user()?->nom[0] }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-700 truncate">{{ auth()->user()?->prenom }} {{ auth()->user()?->nom }}</p>
                    <p class="text-xs text-slate-400">Administrateur</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">
                        Quitter
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Contenu --}}
    <main class="ml-64 flex-1 p-8">
        @if(session('success'))
            <div class="bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl p-4 mb-6 text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 text-red-600 border border-red-200 rounded-xl p-4 mb-6 text-sm">
                ❌ {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>