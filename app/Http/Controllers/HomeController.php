<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Categorie;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        // Statistiques pour la page d'accueil
        $stats = [
            'total_offres' => Offre::where('statut', 'active')->count(),
            'total_entreprises' => Entreprise::where('statut', 'validee')->count(),
            'total_stages' => Offre::whereIn('type_offre', ['stage_professionnel', 'stage_academique'])
                                   ->where('statut', 'active')
                                   ->count(),
        ];

        // Dernières offres publiées (6 plus récentes)
        $dernieresOffres = Offre::with(['entreprise', 'categorie'])
            ->where('statut', 'active')
            ->latest()
            ->take(6)
            ->get();

        // Catégories avec nombre d'offres actives
        $categories = Categorie::withCount(['offres' => function ($query) {
            $query->where('statut', 'active');
        }])
        ->where('is_active', true)
        ->get()
        ->filter(function ($categorie) {
            return $categorie->offres_count > 0;
        })
        ->sortByDesc('offres_count')
        ->take(8);

        return view('home', compact('stats', 'dernieresOffres', 'categories'));
    }

    /**
     * Page À propos
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Page Contact
     */
    public function contact()
    {
        return view('contact');
    }
}