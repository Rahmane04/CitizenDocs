<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

public function store(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }

    $request->session()->regenerate();

    $role = auth()->user()->role;

    return match($role) {
        'admin'  => redirect()->route('admin.dashboard'),
        'agent'  => redirect()->route('agent.dashboard'),
        default  => redirect()->route('citoyen.dashboard'),
    };
}

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}