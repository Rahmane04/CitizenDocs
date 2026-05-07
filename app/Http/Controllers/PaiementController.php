<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    // Afficher la page de paiement
    public function create(Demande $demande)
    {
        return view('citoyen.paiements.create', compact('demande'));
    }

    // Traiter le paiement
    public function store(Request $request, Demande $demande)
    {
        $request->validate([
            'methode' => 'required|in:wave,orange_money',
        ]);

        // Simulation du paiement
        Paiement::updateOrCreate(
            ['demande_id' => $demande->id],
            [
                'montant'        => $demande->typeDocument->prix,
                'methode'        => $request->methode,
                'statut'         => 'confirme',
                'transaction_id' => strtoupper($request->methode) . '-' . uniqid(),
            ]
        );

        return redirect()->route('citoyen.demandes.index')
            ->with('success', 'Paiement effectué avec succès !');
    }
    public function index()
{
    $paiements = auth()->user()->demandes()
        ->with(['paiement', 'typeDocument'])
        ->whereHas('paiement')
        ->get();

    return view('citoyen.paiements.index', compact('paiements'));
}
}