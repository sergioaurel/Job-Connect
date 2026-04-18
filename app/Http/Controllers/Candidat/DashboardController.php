<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tableau de bord du candidat
     */
    public function index()
    {
        $user = auth()->user();

        // Charger les relations pour les recommandations
        $user->load('formations', 'competences');

        // Statistiques
        $stats = [
            'total_candidatures'      => $user->candidatures()->count(),
            'candidatures_en_attente' => $user->candidatures()->where('statut', 'en_attente')->count(),
            'candidatures_retenues'   => $user->candidatures()->where('statut', 'retenue')->count(),
            'profil_complet'          => $user->profilComplete() ? 'Oui' : 'Non',
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

        // ✦ Recommandations — retourne ['offres' => ..., 'message' => ...]
        $result                 = $user->getRecommandations(6);
        $recommandations        = $result['offres'];
        $messageRecommandations = $result['message'];

        return view('candidat.dashboard', compact(
            'stats', 'candidatures', 'favoris', 'recommandations', 'messageRecommandations'
        ));
    }

    /**
     * Page dédiée aux recommandations personnalisées
     */
    public function recommandations()
    {
        $user = auth()->user();
        $user->load('formations', 'competences');

        // Récupère plus d'offres pour la page dédiée
        $result                 = $user->getRecommandations(24);
        $recommandations        = $result['offres'];
        $messageRecommandations = $result['message'];

        // Infos de contexte
        $domaines = $user->formations->pluck('domaine')->filter()->unique()->values();
        $diplomes = $user->formations->pluck('diplome')->filter()->unique()->values();

        return view('candidat.recommandations', compact(
            'recommandations', 'domaines', 'diplomes', 'messageRecommandations'
        ));
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