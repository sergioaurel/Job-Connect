<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Offre;
use App\Models\Candidature;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'admin']);
    // }

    /**
     * Page des statistiques détaillées
     */
    public function index()
    {
        // Statistiques générales
        $stats = [
            'total_utilisateurs' => User::count(),
            'total_candidats' => User::where('role', 'candidat')->count(),
            'total_entreprises_validees' => Entreprise::where('statut', 'validee')->count(),
            'total_offres_actives' => Offre::where('statut', 'active')->count(),
            'total_candidatures' => Candidature::count(),
            'taux_reussite' => $this->calculerTauxReussite(),
        ];

        // Offres par catégorie
        $offresParCategorie = Categorie::withCount(['offres' => function ($query) {
            $query->where('statut', 'active');
        }])
        ->having('offres_count', '>', 0)
        ->orderBy('offres_count', 'desc')
        ->get();

        // Offres par type
        $offresParType = Offre::select('type_offre', DB::raw('count(*) as total'))
            ->where('statut', 'active')
            ->groupBy('type_offre')
            ->get();

        // Évolution des inscriptions (6 derniers mois)
        $inscriptionsParMois = User::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mois'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

        // Candidatures par statut
        $candidaturesParStatut = Candidature::select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->get();

        // Top 5 des villes avec le plus d'offres
        $topVilles = Offre::select('ville', DB::raw('count(*) as total'))
            ->where('statut', 'active')
            ->groupBy('ville')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('admin.statistiques', compact(
            'stats',
            'offresParCategorie',
            'offresParType',
            'inscriptionsParMois',
            'candidaturesParStatut',
            'topVilles'
        ));
    }

    /**
     * Calculer le taux de réussite (candidatures retenues / total)
     */
    private function calculerTauxReussite()
    {
        $total = Candidature::count();
        
        if ($total == 0) {
            return 0;
        }

        $retenues = Candidature::where('statut', 'retenue')->count();

        return round(($retenues / $total) * 100, 2);
    }
}