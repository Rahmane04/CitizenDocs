<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'demande_id', 'fichier_path',
        'date_generation', 'telecharge'
    ];

    protected $casts = [
        'date_generation' => 'datetime',
        'telecharge' => 'boolean'
    ];

    // Le document appartient à une demande
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }
}