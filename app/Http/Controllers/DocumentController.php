<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    // Télécharger le document
    public function download(Demande $demande)
    {
        // Vérifier que la demande est validée
        if ($demande->statut !== 'validee') {
            return back()->with('error', 'Ce document n\'est pas encore disponible.');
        }

        // Vérifier que le citoyen est bien le propriétaire
        if ($demande->citoyen_id !== auth()->id()) {
            abort(403);
        }

        // Générer un PDF simple
        $content = "CITIZENDOCS - DOCUMENT OFFICIEL\n\n";
        $content .= "Référence : " . $demande->reference . "\n";
        $content .= "Type : " . $demande->typeDocument->nom . "\n";
        $content .= "Citoyen : " . $demande->citoyen->prenom . " " . $demande->citoyen->nom . "\n";
        $content .= "Date de validation : " . $demande->updated_at->format('d/m/Y') . "\n";
        $content .= "\nCe document a été généré automatiquement par CitizenDocs.";

        // Marquer comme téléchargé
        Document::updateOrCreate(
            ['demande_id' => $demande->id],
            [
                'fichier_path'    => 'documents/' . $demande->reference . '.txt',
                'date_generation' => now(),
                'telecharge'      => true,
            ]
        );

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $demande->reference . '.txt"');
    }
}