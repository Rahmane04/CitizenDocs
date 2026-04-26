<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TypeDocument;
use App\Models\Demande;
use App\Models\Paiement;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ── Dashboard ──────────────────────────────────
    public function dashboard()
    {
        $stats = [
            'total_users'     => User::count(),
            'total_demandes'  => Demande::count(),
            'total_paiements' => Paiement::sum('montant'),
            'demandes_statut' => Demande::selectRaw('statut, count(*) as total')
                                    ->groupBy('statut')->get(),
            'demandes_type'   => Demande::selectRaw('type_document_id, count(*) as total')
                                    ->with('typeDocument')
                                    ->groupBy('type_document_id')->get(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // ── Utilisateurs ───────────────────────────────
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function toggleUser(User $user)
    {
        $newStatut = $user->statut === 'actif' ? 'inactif' : 'actif';
        $user->update(['statut' => $newStatut]);
        return back()->with('success', "Compte {$newStatut} avec succès.");
    }

    // ── Types de documents ─────────────────────────
    public function typeDocuments()
    {
        $types = TypeDocument::orderBy('nom')->paginate(10);
        return view('admin.type_documents.index', compact('types'));
    }

    public function createTypeDocument()
    {
        return view('admin.type_documents.create');
    }

    public function storeTypeDocument(Request $request)
    {
        $request->validate([
            'nom'              => 'required|string|max:255|unique:type_documents',
            'description'      => 'nullable|string',
            'prix'             => 'required|numeric|min:0',
            'delai_traitement' => 'required|integer|min:1',
        ]);
        TypeDocument::create($request->all());
        return redirect()->route('admin.type_documents')
                         ->with('success', 'Type de document créé.');
    }

    public function editTypeDocument(TypeDocument $typeDocument)
    {
        return view('admin.type_documents.edit', compact('typeDocument'));
    }

    public function updateTypeDocument(Request $request, TypeDocument $typeDocument)
    {
        $request->validate([
            'nom'              => 'required|string|max:255|unique:type_documents,nom,' . $typeDocument->id,
            'description'      => 'nullable|string',
            'prix'             => 'required|numeric|min:0',
            'delai_traitement' => 'required|integer|min:1',
        ]);
        $typeDocument->update($request->all());
        return redirect()->route('admin.type_documents')
                         ->with('success', 'Type de document mis à jour.');
    }

    public function destroyTypeDocument(TypeDocument $typeDocument)
    {
        $typeDocument->delete();
        return back()->with('success', 'Type de document supprimé.');
    }

    // ── Rapports ───────────────────────────────────
    public function rapports()
    {
        $demandesParStatut = Demande::selectRaw('statut, count(*) as total')
                                ->groupBy('statut')->get();
        $demandesParType   = Demande::selectRaw('type_document_id, count(*) as total')
                                ->with('typeDocument')
                                ->groupBy('type_document_id')->get();
        $totalPaiements    = Paiement::sum('montant');
        $paiementsParMois  = Paiement::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')
                                ->groupBy('mois')->orderBy('mois')->get();

        return view('admin.rapports', compact(
            'demandesParStatut',
            'demandesParType',
            'totalPaiements',
            'paiementsParMois'
        ));
    }
}