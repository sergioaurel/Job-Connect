<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'candidat']);
    // }

    /**
     * Tableau de bord du candidat
     */
    public function index()
    {
        $user = auth()->user();

        // Statistiques
        $stats = [
            'total_candidatures' => $user->candidatures()->count(),
            'candidatures_en_attente' => $user->candidatures()->where('statut', 'en_attente')->count(),
            'candidatures_retenues' => $user->candidatures()->where('statut', 'retenue')->count(),
            'profil_complet' => $user->profilComplete() ? 'Oui' : 'Non',
        ];

        // Dernières candidatures
        $candidatures = $user->candidatures()
            ->with(['offre.entreprise', 'offre.categorie'])
            ->latest()
            ->take(5)
            ->get();

        // Offres favorites
        $favoris = $user->favoris()
            ->with(['entreprise', 'categorie'])
            ->where('statut', 'active')
            ->latest('favoris.created_at')
            ->take(4)
            ->get();

        return view('candidat.dashboard', compact('stats', 'candidatures', 'favoris'));
    }

    /**
     * Liste de toutes les candidatures
     */
    public function candidatures()
    {
        $candidatures = auth()->user()->candidatures()
            ->with(['offre.entreprise', 'offre.categorie'])
            ->latest()
            ->paginate(10);

        return view('candidat.candidatures', compact('candidatures'));
    }

    /**
     * Mes offres favorites
     */
    public function favoris()
    {
        $favoris = auth()->user()->favoris()
            ->with(['entreprise', 'categorie'])
            ->latest('favoris.created_at')
            ->paginate(12);

        return view('candidat.favoris', compact('favoris'));
    }
}