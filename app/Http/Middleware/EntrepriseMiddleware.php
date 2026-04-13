<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntrepriseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!auth()->check() || !$user->isEntreprise()) {
            abort(403, 'Accès non autorisé.');
        }

        // Bloquer les comptes suspendus par l'administrateur (double vérification)
        // — via user.is_active (verrou session)
        // — via entreprise.statut (verrou profil, défense en profondeur)
        $entreprise = $user->entreprise;

        if (!$user->is_active || ($entreprise && $entreprise->isSuspendue())) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')
                ->with('error', 'Votre compte a été suspendu. Veuillez contacter l\'administrateur.');
        }

        return $next($request);
    }
}