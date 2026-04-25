<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom', 'prenom', 'email', 'password',
        'telephone', 'role', 'statut'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    // Un citoyen a plusieurs demandes
    public function demandes()
    {
        return $this->hasMany(Demande::class, 'citoyen_id');
    }

    // Un agent traite plusieurs demandes
    public function demandesTraitees()
    {
        return $this->hasMany(Demande::class, 'agent_id');
    }
}