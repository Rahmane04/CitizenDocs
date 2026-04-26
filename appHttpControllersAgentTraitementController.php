<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TraitementController extends Controller
{
    public function index(Request $request)
    {
        $statut = $request->get('statut');

        $demandes = Demande::with(['citoyen', 'typeDocument', 'agent'])
            ->when($statut, fn($q) => $q->where('statut', $statut))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('agent.demandes.index', compact('demandes', 'statut'));
    }

    public function show(Demande $demande)
    {
        $demande->load(['citoyen', 'typeDocument', 'agent', 'paiement', 'document']);
        return view('agent.demandes.show', compact('demande'));
    }

    public function traiter(Request $request, Demande $demande)
    {
        $request->validate([
            'statut'      => 'required|in:validee,rejetee',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        if (in_array($demande->statut, ['validee', 'rejetee'])) {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $demande->update([
            'statut'      => $request->statut,
            'commentaire' => $request->commentaire,
            'agent_id'    => Auth::id(),
        ]);

        $message = $request->statut === 'validee'
            ? 'Demande validée avec succès.'
            : 'Demande rejetée.';

        return redirect()
            ->route('agent.demandes.index')
            ->with('success', $message);
    }
}
