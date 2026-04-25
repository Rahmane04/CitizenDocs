<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = [
        'reference', 'citoyen_id', 'type_document_id',
        'agent_id', 'statut', 'commentaire'
    ];

    // La demande appartient à un citoyen
    public function citoyen()
    {
        return $this->belongsTo(User::class, 'citoyen_id');
    }

    // La demande est traitée par un agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    // La demande est d'un certain type de document
    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class, 'type_document_id');
    }

    // La demande a un paiement
    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'demande_id');
    }

    // La demande génère un document
    public function document()
    {
        return $this->hasOne(Document::class, 'demande_id');
    }
}