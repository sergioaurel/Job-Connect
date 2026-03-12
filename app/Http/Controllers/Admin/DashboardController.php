<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Offre;
use App\Models\Candidature;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $stats = [
            'total_utilisateurs' => User::count(),
            'total_candidats' => User::where('role', 'candidat')->count(),
            'total_entreprises' => Entreprise::count(),
            'entreprises_en_attente' => Entreprise::where('statut', 'en_attente')->count(),
            'total_offres' => Offre::count(),
            'offres_actives' => Offre::where('statut', 'active')->count(),
            'total_candidatures' => Candidature::count(),
            'candidatures_mois' => Candidature::whereMonth('created_at', date('m'))->count(),
        ];

        $entreprisesEnAttente = Entreprise::where('statut', 'en_attente')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        $dernieresOffres = Offre::with(['entreprise', 'categorie'])
            ->latest()
            ->take(5)
            ->get();

        $derniersUtilisateurs = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'entreprisesEnAttente',
            'dernieresOffres',
            'derniersUtilisateurs'
        ));
    }
}