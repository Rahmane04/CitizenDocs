<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::where('citoyen_id', Auth::id())
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('citoyen.demandes.index', compact('demandes'));
    }

    public function create()
    {
        $typeDocuments = TypeDocument::all();
        return view('citoyen.demandes.create', compact('typeDocuments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_document_id' => 'required|exists:type_documents,id',
        ]);

        Demande::create([
            'reference'        => $this->genererReference(),
            'citoyen_id'       => Auth::id(),
            'type_document_id' => $request->type_document_id,
            'statut'           => 'en_attente',
        ]);

        return redirect()->route('citoyen.demandes.index')
                         ->with('success', 'Votre demande a été soumise avec succès.');
    }

    private function genererReference(): string
    {
        $annee    = now()->year;
        $derniere = Demande::whereYear('created_at', $annee)->lockForUpdate()->count();
        $numero   = str_pad($derniere + 1, 3, '0', STR_PAD_LEFT);

        return "DEM-{$annee}-{$numero}";
    }
}
