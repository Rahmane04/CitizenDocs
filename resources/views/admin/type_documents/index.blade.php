@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📄 Types de documents</h1>
        <a href="{{ route('admin.type_documents.create') }}"
           class="bg-blue-800 text-white px-4 py-2.5 rounded-lg hover:bg-blue-900 transition text-sm font-medium">
            + Ajouter un type
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-4 text-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b text-gray-500">
                <tr>
                    <th class="py-3 px-4 text-left font-medium">#</th>
                    <th class="py-3 px-4 text-left font-medium">Nom</th>
                    <th class="py-3 px-4 text-left font-medium">Description</th>
                    <th class="py-3 px-4 text-left font-medium">Prix</th>
                    <th class="py-3 px-4 text-left font-medium">Délai (jours)</th>
                    <th class="py-3 px-4 text-left font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($typeDocuments as $type)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-500">{{ $type->id }}</td>
                    <td class="py-3 px-4 font-medium">{{ $type->nom }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $type->description }}</td>
                    <td class="py-3 px-4 font-semibold text-blue-800">{{ number_format($type->prix, 0, ',', ' ') }} FCFA</td>
                    <td class="py-3 px-4">{{ $type->delai_traitement }} j</td>
                    <td class="py-3 px-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.type_documents.edit', $type) }}"
                               class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-yellow-600 transition">
                                ✏️ Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.type_documents.destroy', $type) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Supprimer ce type ?')"
                                    class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 transition">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection