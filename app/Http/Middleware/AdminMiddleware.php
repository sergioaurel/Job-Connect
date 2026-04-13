<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!auth()->check() || !$user->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        // Sécurité supplémentaire : vérifier que le compte admin est actif
        if (!$user->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')
                ->with('error', 'Votre compte a été désactivé.');
        }

        return $next($request);
    }
}