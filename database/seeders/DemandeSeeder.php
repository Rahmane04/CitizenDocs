<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demande;
use App\Models\Paiement;

class DemandeSeeder extends Seeder
{
    public function run(): void
    {
        // Demande 1 — en attente
        $demande1 = Demande::create([
            'reference'         => 'DEM-2026-001',
            'citoyen_id'        => 3,
            'type_document_id'  => 1,
            'agent_id'          => null,
            'statut'            => 'en_attente',
            'commentaire'       => null
        ]);

        Paiement::create([
            'demande_id'     => $demande1->id,
            'montant'        => 1000,
            'methode'        => 'wave',
            'statut'         => 'confirme',
            'transaction_id' => 'WAV-123456'
        ]);

        // Demande 2 — validée
        $demande2 = Demande::create([
            'reference'         => 'DEM-2026-002',
            'citoyen_id'        => 3,
            'type_document_id'  => 2,
            'agent_id'          => 2,
            'statut'            => 'validee',
            'commentaire'       => 'Dossier complet, document généré'
        ]);

        Paiement::create([
            'demande_id'     => $demande2->id,
            'montant'        => 500,
            'methode'        => 'orange_money',
            'statut'         => 'confirme',
            'transaction_id' => 'OM-789012'
        ]);
    }
}