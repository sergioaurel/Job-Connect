<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidatMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!auth()->check() || !$user->isCandidat()) {
            abort(403, 'Accès non autorisé.');
        }

        // Bloquer les comptes suspendus par l'administrateur
        if (!$user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')
                ->with('error', 'Votre compte a été suspendu. Veuillez contacter l\'administrateur.');
        }

        return $next($request);
    }
}