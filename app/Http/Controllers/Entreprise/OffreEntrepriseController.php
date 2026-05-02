<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use App\Models\Categorie;
use Illuminate\Http\Request;

class OffreEntrepriseController extends Controller
{
    /**
     * Liste des offres de l'entreprise
     */
    public function index()
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create');
        }

        $offres = $entreprise->offres()
            ->withCount('candidatures')
            ->latest()
            ->paginate(10);

        return view('entreprise.offres.index', compact('offres', 'entreprise'));
    }

    /**
     * Formulaire de création d'offre
     */
    public function create()
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create');
        }

        if (!$entreprise->isValidee()) {
            return redirect()->route('entreprise.dashboard')
                ->with('error', 'Votre entreprise doit être validée avant de publier des offres.');
        }

        $categories = Categorie::where('is_active', true)->orderBy('nom')->get();

        return view('entreprise.offres.create', compact('categories'));
    }

    /**
     * Enregistrer une nouvelle offre
     */
    public function store(Request $request)
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise || !$entreprise->isValidee()) {
            return redirect()->route('entreprise.dashboard')
                ->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'categorie_id'         => 'required|exists:categories,id',
            'titre'                => 'required|string|max:255',
            'type_offre'           => 'required|in:stage_professionnel,stage_academique',
            'description'          => 'required|string|min:100',
            'missions'             => 'required|string|min:50',
            'profil_recherche'     => 'required|string|min:50',
            'competences_requises' => 'nullable|string',
            'niveau_etude'         => 'required|string|max:255',
            'annees_experience'    => 'required|integer|min:0',
            'ville'                => 'required|string|max:255',
            'salaire_min'          => 'nullable|numeric|min:0',
            'salaire_max'          => 'nullable|numeric|min:0|gte:salaire_min',
            'salaire_a_negocier'   => 'boolean',
            'nombre_postes'        => 'required|integer|min:1',
            'date_limite'          => 'nullable|date|after:today',
        ], [
            'categorie_id.required'  => 'La catégorie est obligatoire.',
            'titre.required'         => 'Le titre est obligatoire.',
            'description.min'        => 'La description doit contenir au moins 100 caractères.',
            'missions.min'           => 'Les missions doivent contenir au moins 50 caractères.',
            'profil_recherche.min'   => 'Le profil recherché doit contenir au moins 50 caractères.',
            'date_limite.after'      => 'La date limite doit être dans le futur.',
            'salaire_max.gte'        => 'La gratification maximum doit être supérieure ou égale au minimum.',
        ]);

        Offre::create([
            'entreprise_id'        => $entreprise->id,
            'categorie_id'         => $request->categorie_id,
            'titre'                => $request->titre,
            'type_offre'           => $request->type_offre,
            'type_contrat'         => null,
            'description'          => $request->description,
            'missions'             => $request->missions,
            'profil_recherche'     => $request->profil_recherche,
            'competences_requises' => $request->competences_requises,
            'niveau_etude'         => $request->niveau_etude,
            'annees_experience'    => $request->annees_experience,
            'ville'                => $request->ville,
            'salaire_min'          => $request->salaire_min,
            'salaire_max'          => $request->salaire_max,
            'salaire_a_negocier'   => $request->boolean('salaire_a_negocier'),
            'nombre_postes'        => $request->nombre_postes,
            'date_limite'          => $request->date_limite,
            'statut'               => 'active',
        ]);

        return redirect()->route('entreprise.offres.index')
            ->with('success', 'Offre de stage publiée avec succès !');
    }

    /**
     * Afficher une offre
     */
    public function show($id)
    {
        $entreprise = auth()->user()->entreprise;
        $offre = Offre::where('entreprise_id', $entreprise->id)
            ->with(['categorie', 'candidatures.candidat'])
            ->findOrFail($id);

        return view('entreprise.offres.show', compact('offre'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit($id)
    {
        $entreprise = auth()->user()->entreprise;
        $offre      = Offre::where('entreprise_id', $entreprise->id)
            ->withCount('candidatures')
            ->findOrFail($id);
        $categories = Categorie::where('is_active', true)->orderBy('nom')->get();

        return view('entreprise.offres.edit', compact('offre', 'categories'));
    }

    /**
     * Mettre à jour une offre
     * ── Bloqué si des candidatures existent ──
     */
    public function update(Request $request, $id)
    {
        $entreprise = auth()->user()->entreprise;
        $offre      = Offre::where('entreprise_id', $entreprise->id)->findOrFail($id);

        // ── Protection des candidats : bloquer toute modification des termes ──
        if ($offre->candidatures()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cette offre ne peut plus être modifiée. Des candidats ont déjà postulé et les termes de l\'offre doivent rester identiques à ce qu\'ils ont vu au moment de leur candidature.');
        }

        $request->validate([
            'categorie_id'         => 'required|exists:categories,id',
            'titre'                => 'required|string|max:255',
            'type_offre'           => 'required|in:stage_professionnel,stage_academique',
            'description'          => 'required|string|min:100',
            'missions'             => 'required|string|min:50',
            'profil_recherche'     => 'required|string|min:50',
            'competences_requises' => 'nullable|string',
            'niveau_etude'         => 'required|string|max:255',
            'annees_experience'    => 'required|integer|min:0',
            'ville'                => 'required|string|max:255',
            'salaire_min'          => 'nullable|numeric|min:0',
            'salaire_max'          => 'nullable|numeric|min:0|gte:salaire_min',
            'salaire_a_negocier'   => 'boolean',
            'nombre_postes'        => 'required|integer|min:1',
            'date_limite'          => 'nullable|date|after:today',
        ]);

        $offre->update($request->only([
            'categorie_id', 'titre', 'type_offre',
            'description', 'missions', 'profil_recherche',
            'competences_requises', 'niveau_etude', 'annees_experience',
            'ville', 'salaire_min', 'salaire_max',
            'nombre_postes', 'date_limite',
        ]) + ['salaire_a_negocier' => $request->boolean('salaire_a_negocier')]);

        return redirect()->route('entreprise.offres.index')
            ->with('success', 'Offre mise à jour avec succès !');
    }

    /**
     * Changer le statut — toujours autorisé même si des candidatures existent
     */
    public function changeStatus($id, Request $request)
    {
        $entreprise = auth()->user()->entreprise;
        $offre      = Offre::where('entreprise_id', $entreprise->id)->findOrFail($id);

        $request->validate([
            'statut' => 'required|in:active,fermee,pourvue',
        ]);

        $offre->update(['statut' => $request->statut]);

        $messages = [
            'active'  => 'Offre réactivée.',
            'fermee'  => 'Offre fermée.',
            'pourvue' => 'Offre marquée comme pourvue.',
        ];

        return redirect()->back()->with('success', $messages[$request->statut]);
    }

    /**
     * Supprimer une offre — bloqué si candidatures existent
     */
    public function destroy($id)
    {
        $entreprise = auth()->user()->entreprise;
        $offre      = Offre::where('entreprise_id', $entreprise->id)->findOrFail($id);

        if ($offre->candidatures()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer une offre ayant des candidatures. Fermez-la à la place.');
        }

        $offre->delete();

        return redirect()->route('entreprise.offres.index')
            ->with('success', 'Offre supprimée avec succès.');
    }
}