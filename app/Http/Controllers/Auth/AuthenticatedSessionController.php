<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Vérifier si le compte est actif (non suspendu par l'admin)
        if (!auth()->user()->is_active) {
            Auth::guard('web')->logout();
            return back()->withErrors([
                'email' => 'Votre compte a été suspendu. Veuillez contacter l\'administrateur.',
            ]);
        }

        $request->session()->regenerate();

        // Redirection selon le rôle
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        } elseif ($user->isEntreprise()) {
            return redirect()->intended(route('entreprise.dashboard'));
        } elseif ($user->isCandidat()) {
            return redirect()->intended(route('candidat.dashboard'));
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
