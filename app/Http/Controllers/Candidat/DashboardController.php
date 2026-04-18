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

        // ✦ Recommandations — basées sur formations + localisation + type_contrat_souhaite
        $recommandations = $user->getRecommandations(6);

        return view('candidat.dashboard', compact(
            'stats', 'candidatures', 'favoris', 'recommandations'
        ));
    }

    /**
     * Page dédiée aux recommandations personnalisées
     */
    public function getRecommandations(int $limit = 6)
    {
        if (!$this->relationLoaded('formations')) {
            $this->load('formations');
        }

        $diplomes = $this->formations->pluck('diplome')->filter()->unique()->toArray();

        // Si aucun critère → retourner les plus récentes
        if (empty($diplomes) && !$this->localisation && !$this->type_contrat_souhaite) {
            return Offre::with(['entreprise', 'categorie'])
                ->where('statut', 'active')
                ->latest()
                ->take($limit)
                ->get();
        }

        $query = Offre::with(['entreprise', 'categorie'])
            ->where('statut', 'active');

        // ── Critère 1 : Diplôme dans niveau_etude ou profil_recherche ──
        if (!empty($diplomes)) {
            $query->where(function ($q) use ($diplomes) {
                foreach ($diplomes as $diplome) {
                    $q->orWhere('niveau_etude', 'like', "%{$diplome}%")
                    ->orWhere('profil_recherche', 'like', "%{$diplome}%");
                }
            });
        }

        // ── Critère 2 : Type de contrat souhaité ──
        // Tous les types sont pris en compte
        if ($this->type_contrat_souhaite) {
            if ($this->type_contrat_souhaite === 'stage_academique') {
                $query->where('type_offre', 'stage_academique');
            } elseif ($this->type_contrat_souhaite === 'stage_professionnel') {
                $query->where('type_offre', 'stage_professionnel');
            } else {
                // CDI, CDD, temps_partiel, freelance → type_offre = emploi
                // ET on essaie de matcher le type_contrat exact si possible
                $query->where('type_offre', 'emploi')
                    ->where(function ($q) {
                        $q->where('type_contrat', $this->type_contrat_souhaite)
                            ->orWhereNull('type_contrat');
                    });
            }
        }

        // ── Critère 3 : Localisation ──
        if ($this->localisation) {
            $ville = trim(explode(',', $this->localisation)[0]);
            $query->where(function ($q) use ($ville) {
                $q->where('ville', 'like', "%{$ville}%")
                ->orWhereNull('ville');
            });
        }

        return $query->latest()->take($limit)->get();
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