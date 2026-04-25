<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    protected $fillable = [
        'nom', 'description', 'prix', 'delai_traitement'
    ];

    // Un type de document est lié à plusieurs demandes
    public function demandes()
    {
        return $this->hasMany(Demande::class, 'type_document_id');
    }
}