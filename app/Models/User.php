<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

protected $fillable = [
    'nom', 'prenom', 'email', 'password',
    'telephone', 'role', 'statut',
    'otp_code', 'otp_expires_at', 'email_verified'
];

protected $casts = [
    'otp_expires_at' => 'datetime',
    'email_verified' => 'boolean',
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