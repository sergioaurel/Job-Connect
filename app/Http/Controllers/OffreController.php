<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Categorie;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    /**
     * Liste de toutes les offres avec filtres
     */
    public function index(Request $request)
    {
        $query = Offre::with(['entreprise', 'categorie'])
            ->where('statut', 'active');

        // Filtre par recherche (titre ou description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        // Filtre par type d'offre
        if ($request->filled('type_offre')) {
            $query->where('type_offre', $request->type_offre);
        }

        // Filtre par ville
        if ($request->filled('ville')) {
            $query->where('ville', $request->ville);
        }

        // Filtre par type de contrat
        if ($request->filled('type_contrat')) {
            $query->where('type_contrat', $request->type_contrat);
        }

        // Tri
        $sortBy = $request->get('sort', 'recent');
        switch ($sortBy) {
            case 'recent':
                $query->latest();
                break;
            case 'popular':
                $query->orderBy('vues', 'desc');
                break;
            case 'deadline':
                $query->orderBy('date_limite', 'asc');
                break;
        }

        // Pagination
        $offres = $query->paginate(12);

        // Données pour les filtres
        $categories = Categorie::where('is_active', true)->get();
        $villes = Offre::where('statut', 'active')
            ->distinct()
            ->pluck('ville')
            ->sort();

        return view('offres.index', compact('offres', 'categories', 'villes'));
    }

    /**
     * Afficher une offre spécifique
     */
    public function show($slug)
    {
        $offre = Offre::with(['entreprise.user', 'categorie'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Incrémenter le nombre de vues
        $offre->incrementerVues();

        // Offres similaires (même catégorie)
        $offresSimilaires = Offre::with(['entreprise', 'categorie'])
            ->where('categorie_id', $offre->categorie_id)
            ->where('id', '!=', $offre->id)
            ->where('statut', 'active')
            ->take(3)
            ->get();

        // Vérifier si l'utilisateur a déjà postulé
        $aPostule = false;
        if (auth()->check() && auth()->user()->isCandidat()) {
            $aPostule = $offre->candidatures()
                ->where('user_id', auth()->id())
                ->exists();
        }

        // Vérifier si l'offre est en favoris
        $estFavori = false;
        if (auth()->check() && auth()->user()->isCandidat()) {
            $estFavori = auth()->user()->favoris()
                ->where('offre_id', $offre->id)
                ->exists();
        }

        return view('offres.show', compact('offre', 'offresSimilaires', 'aPostule', 'estFavori'));
    }

    /**
     * Offres par catégorie
     */
    public function categorie($slug)
    {
        $categorie = Categorie::where('slug', $slug)->firstOrFail();

        $offres = Offre::with(['entreprise', 'categorie'])
            ->where('categorie_id', $categorie->id)
            ->where('statut', 'active')
            ->latest()
            ->paginate(12);

        return view('offres.categorie', compact('categorie', 'offres'));
    }
}