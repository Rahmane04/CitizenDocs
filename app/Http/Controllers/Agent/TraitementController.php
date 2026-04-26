<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use Illuminate\Http\Request;

class TraitementController extends Controller
{
    public function index()
    {
        $statut = request('statut');
        $demandes = Demande::with(['citoyen', 'typeDocument'])
        ->when($statut, fn($q) => $q->where('statut', $statut))
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('agent.demandes.index', compact('demandes', 'statut'));
        }

    public function show(Demande $demande)
    {
        $demande->load(['citoyen', 'typeDocument', 'paiement']);
        return view('agent.demandes.show', compact('demande'));
    }

    public function traiter(Request $request, Demande $demande)
    {
        $request->validate([
            'statut'      => 'required|in:validee,rejetee',
            'commentaire' => 'nullable|string',
        ]);

        $demande->update([
            'statut'      => $request->statut,
            'commentaire' => $request->commentaire,
            'agent_id'    => auth()->id(),
        ]);

        return redirect()->route('agent.demandes.index')
            ->with('success', 'Demande traitée avec succès');
    }
}