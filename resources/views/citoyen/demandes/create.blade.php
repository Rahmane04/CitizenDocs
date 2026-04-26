@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Nouvelle demande</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('citoyen.demandes.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Type de document</label>
            <select name="type_document_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Choisir un type --</option>
                @foreach($typeDocuments as $type)
                    <option value="{{ $type->id }}" {{ old('type_document_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Soumettre la demande
        </button>
    </form>
</div>
@endsection
