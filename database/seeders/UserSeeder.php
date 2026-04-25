<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nom'       => 'Diallo',
            'prenom'    => 'Fatou',
            'email'     => 'admin@citizendocs.sn',
            'password'  => Hash::make('admin123'),
            'telephone' => '771234567',
            'role'      => 'admin',
            'statut'    => 'actif'
        ]);

        // Agent
        User::create([
            'nom'       => 'Ndiaye',
            'prenom'    => 'Moussa',
            'email'     => 'agent@citizendocs.sn',
            'password'  => Hash::make('agent123'),
            'telephone' => '782345678',
            'role'      => 'agent',
            'statut'    => 'actif'
        ]);

        // Citoyen
        User::create([
            'nom'       => 'Sow',
            'prenom'    => 'Rahmane',
            'email'     => 'citoyen@citizendocs.sn',
            'password'  => Hash::make('citoyen123'),
            'telephone' => '701234567',
            'role'      => 'citoyen',
            'statut'    => 'actif'
        ]);
    }
}