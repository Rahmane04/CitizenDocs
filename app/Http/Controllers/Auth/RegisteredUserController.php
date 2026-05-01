<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:8',
            'telephone' => 'nullable|string|max:20',
        ]);

        // Générer un code OTP à 6 chiffres
        $otp = rand(100000, 999999);

        // Créer l'utilisateur sans le connecter
        $user = User::create([
            'nom'            => $request->nom,
            'prenom'         => $request->prenom,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'telephone'      => $request->telephone,
            'role'           => 'citoyen',
            'statut'         => 'actif',
            'email_verified' => false,
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Envoyer l'OTP par email
        Mail::raw("
Bonjour {$user->prenom},

Votre code de vérification CitizenDocs est : {$otp}

Ce code expire dans 10 minutes.

Cordialement,
L'équipe CitizenDocs
        ", function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Code de vérification CitizenDocs');
        });

        // Rediriger vers la page de vérification
        return redirect()->route('verify.otp', ['email' => $user->email])
            ->with('success', 'Un code de vérification a été envoyé à votre adresse email.');
    }
}