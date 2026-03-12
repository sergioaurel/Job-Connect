<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'entreprise']);
    // }

    /**
     * Tableau de bord de l'entreprise
     */
    public function index()
    {
        $user = auth()->user();
        $entreprise = $user->entreprise;

        // Rediriger vers la création du profil si pas encore créé
        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create')
                ->with('info', 'Veuillez d\'abord compléter votre profil entreprise.');
        }

        // Statistiques
        $stats = [
            'total_offres' => $entreprise->offres()->count(),
            'offres_actives' => $entreprise->offres()->where('statut', 'active')->count(),
            'total_candidatures' => $entreprise->totalCandidatures(),
            'candidatures_en_attente' => \App\Models\Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
                ->where('statut', 'en_attente')
                ->count(),
        ];

        // Dernières offres
        $offres = $entreprise->offres()
            ->withCount('candidatures')
            ->latest()
            ->take(5)
            ->get();

        // Dernières candidatures reçues
        $candidatures = \App\Models\Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->with(['offre', 'candidat'])
            ->latest()
            ->take(5)
            ->get();

        return view('entreprise.dashboard', compact('entreprise', 'stats', 'offres', 'candidatures'));
    }

    /**
     * Afficher le formulaire de création de profil entreprise
     */
    public function createProfil()
    {
        // Vérifier si l'entreprise a déjà un profil
        if (auth()->user()->entreprise) {
            return redirect()->route('entreprise.dashboard');
        }

        return view('entreprise.create-profil');
    }

    /**
     * Enregistrer le profil entreprise
     */
    public function storeProfil(Request $request)
    {
        $request->validate([
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'required|string|min:100',
            'secteur_activite' => 'required|string|max:255',
            'site_web' => 'nullable|url',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'telephone_entreprise' => 'required|string|max:20',
            'effectif' => 'nullable|integer|min:1',
            'annee_creation' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nom_entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
            'description.min' => 'La description doit contenir au moins 100 caractères.',
            'site_web.url' => 'Le site web doit être une URL valide.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
        ]);

        // Upload du logo si fourni
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Créer le profil entreprise
        \App\Models\Entreprise::create([
            'user_id' => auth()->id(),
            'nom_entreprise' => $request->nom_entreprise,
            'description' => $request->description,
            'secteur_activite' => $request->secteur_activite,
            'site_web' => $request->site_web,
            'adresse' => $request->adresse,
            'ville' => $request->ville,
            'telephone_entreprise' => $request->telephone_entreprise,
            'effectif' => $request->effectif,
            'annee_creation' => $request->annee_creation,
            'logo' => $logoPath,
            'statut' => 'en_attente', // En attente de validation par l'admin
        ]);

        return redirect()->route('entreprise.dashboard')
            ->with('success', 'Votre profil a été créé avec succès. Il sera validé par un administrateur sous peu.');
    }

    /**
     * Afficher et modifier le profil entreprise
     */
    public function editProfil()
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create');
        }

        return view('entreprise.edit-profil', compact('entreprise'));
    }

    /**
     * Mettre à jour le profil entreprise
     */
    public function updateProfil(Request $request)
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create');
        }

        $request->validate([
            'nom_entreprise' => 'required|string|max:255',
            'description' => 'required|string|min:100',
            'secteur_activite' => 'required|string|max:255',
            'site_web' => 'nullable|url',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'telephone_entreprise' => 'required|string|max:20',
            'effectif' => 'nullable|integer|min:1',
            'annee_creation' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload du nouveau logo si fourni
        $data = $request->except('logo');
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo
            if ($entreprise->logo) {
                \Storage::disk('public')->delete($entreprise->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $entreprise->update($data);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}