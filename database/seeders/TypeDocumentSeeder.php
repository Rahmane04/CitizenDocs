<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeDocument;

class TypeDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'nom'               => 'Acte de naissance',
                'description'       => 'Document officiel attestant la naissance',
                'prix'              => 1000,
                'delai_traitement'  => 3
            ],
            [
                'nom'               => 'Certificat de résidence',
                'description'       => 'Atteste le lieu de résidence du citoyen',
                'prix'              => 500,
                'delai_traitement'  => 2
            ],
            [
                'nom'               => 'Casier judiciaire',
                'description'       => 'Extrait du casier judiciaire national',
                'prix'              => 2000,
                'delai_traitement'  => 5
            ],
            [
                'nom'               => 'Carte nationale d\'identité',
                'description'       => 'Pièce d\'identité officielle',
                'prix'              => 3000,
                'delai_traitement'  => 7
            ],
        ];

        foreach ($types as $type) {
            TypeDocument::create($type);
        }
    }
}