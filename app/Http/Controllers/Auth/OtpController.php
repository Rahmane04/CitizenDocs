<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.verify-otp', ['email' => $request->email]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Utilisateur introuvable.']);
        }

        if ($user->otp_code !== $request->otp) {
            return back()->withErrors(['otp' => 'Code incorrect.']);
        }

        if (now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Code expiré. Veuillez vous réinscrire.']);
        }

        // Valider le compte
        $user->update([
            'email_verified' => true,
            'otp_code'       => null,
            'otp_expires_at' => null,
        ]);

        Auth::login($user);

        return redirect()->route('citoyen.dashboard')
            ->with('success', 'Compte vérifié avec succès !');
    }
}