<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'demande_id', 'montant', 'methode',
        'statut', 'transaction_id'
    ];

    // Le paiement appartient à une demande
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }
}