@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.users') }}"
           class="text-sm text-gray-500 hover:text-gray-700">← Retour</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-1">➕ Créer un compte agent</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.agents.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition">
                Créer le compte agent
            </button>
        </form>
    </div>
</div>
@endsection