<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'admin']);
    // }

    /**
     * Liste de toutes les entreprises
     */
    public function index(Request $request)
    {
        $query = Entreprise::with('user');

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Recherche par nom
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nom_entreprise', 'like', "%{$search}%");
        }

        $entreprises = $query->latest()->paginate(15);

        return view('admin.entreprises.index', compact('entreprises'));
    }

    /**
     * Voir les détails d'une entreprise
     */
    public function show($id)
    {
        $entreprise = Entreprise::with(['user', 'offres'])->findOrFail($id);

        return view('admin.entreprises.show', compact('entreprise'));
    }

    /**
     * Valider une entreprise
     */
    public function valider($id)
    {
        $entreprise = Entreprise::findOrFail($id);

        $entreprise->update(['statut' => 'validee']);

        // Ici, vous pouvez envoyer un email de notification à l'entreprise

        return redirect()->back()->with('success', 'Entreprise validée avec succès.');
    }

    /**
     * Rejeter une entreprise
     */
    public function rejeter($id, Request $request)
    {
        $entreprise = Entreprise::findOrFail($id);

        $request->validate([
            'raison' => 'nullable|string|max:500',
        ]);

        $entreprise->update(['statut' => 'rejetee']);

        // Ici, vous pouvez envoyer un email avec la raison du rejet

        return redirect()->back()->with('success', 'Entreprise rejetée.');
    }

    /**
     * Suspendre une entreprise.
     * Met à jour SIMULTANÉMENT :
     *  - user.is_active     → bloque l'accès à la session
     *  - entreprise.statut  → affiche "Suspendue" dans l'interface admin
     */
    public function suspendre($id)
    {
        $entreprise = Entreprise::with('user')->findOrFail($id);

        // Bloquer le compte utilisateur
        $entreprise->user->update(['is_active' => false]);

        // Refléter visuellement la suspension dans le statut du profil
        $entreprise->update(['statut' => 'suspendue']);

        return redirect()->back()->with('success', 'Entreprise suspendue avec succès.');
    }

    /**
     * Réactiver une entreprise suspendue.
     * Met à jour SIMULTANÉMENT :
     *  - user.is_active     → restaure l'accès
     *  - entreprise.statut  → repasse à "Validée"
     */
    public function reactiver($id)
    {
        $entreprise = Entreprise::with('user')->findOrFail($id);

        // Réactiver le compte utilisateur
        $entreprise->user->update(['is_active' => true]);

        // Remettre le statut du profil à "validée"
        $entreprise->update(['statut' => 'validee']);

        return redirect()->back()->with('success', 'Entreprise réactivée avec succès.');
    }
}