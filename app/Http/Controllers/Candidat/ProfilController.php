<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Competence;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Afficher le profil
     */
    public function index()
    {
        $user              = auth()->user();
        $experiences       = $user->experiences()->latest('date_debut')->get();
        $formations        = $user->formations()->orderBy('annee_obtention', 'desc')->get();
        $competences       = $user->competences;
        $toutesCompetences = Competence::orderBy('nom')->get();

        // Listes pour les selects
        $villes       = User::getVillesBenin();
        $diplomes     = User::getDiplomes();
        $domaines     = User::getDomaines();
        $typesContrat = User::getTypesContratSouhaite();

        return view('candidat.profil', compact(
            'user', 'experiences', 'formations', 'competences',
            'toutesCompetences', 'villes', 'diplomes', 'domaines', 'typesContrat'
        ));
    }

    /**
     * Mettre à jour les infos personnelles
     * On sauvegarde aussi type_contrat_souhaite
     */
    public function updateInfos(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'telephone'             => 'required|string|max:20',
            'localisation'          => 'required|string|max:255',
            'type_contrat_souhaite' => 'nullable|string|max:50',
        ]);

        auth()->user()->update($request->only([
            'name',
            'telephone',
            'localisation',
            'type_contrat_souhaite',
        ]));

        return redirect()->route('candidat.profil')
            ->with('success', 'Profil mis à jour. Vos recommandations ont été recalculées.');
    }

    /**
     * Ajouter une expérience
     */
    public function addExperience(Request $request)
    {
        $request->validate([
            'poste'       => 'required|string|max:255',
            'entreprise'  => 'required|string|max:255',
            'ville'       => 'nullable|string|max:255',
            'date_debut'  => 'required|date',
            'date_fin'    => 'nullable|date|after:date_debut',
            'en_cours'    => 'boolean',
            'description' => 'nullable|string',
        ]);

        Experience::create([
            'user_id'     => auth()->id(),
            'poste'       => $request->poste,
            'entreprise'  => $request->entreprise,
            'ville'       => $request->ville,
            'date_debut'  => $request->date_debut,
            'date_fin'    => $request->en_cours ? null : $request->date_fin,
            'en_cours'    => $request->boolean('en_cours'),
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Expérience ajoutée avec succès.');
    }

    /**
     * Supprimer une expérience
     */
    public function deleteExperience($id)
    {
        Experience::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Expérience supprimée.');
    }

    /**
     * Ajouter une formation
     */
    public function addFormation(Request $request)
    {
        $request->validate([
            'diplome'         => 'required|string|max:255',
            'etablissement'   => 'required|string|max:255',
            'domaine'         => 'nullable|string|max:255',
            'annee_obtention' => 'required|integer|min:1950|max:' . (date('Y') + 5),
            'description'     => 'nullable|string',
        ]);

        Formation::create([
            'user_id'         => auth()->id(),
            'diplome'         => $request->diplome,
            'etablissement'   => $request->etablissement,
            'domaine'         => $request->domaine,
            'annee_obtention' => $request->annee_obtention,
            'description'     => $request->description,
        ]);

        return redirect()->back()->with('success', 'Formation ajoutée avec succès.');
    }

    /**
     * Supprimer une formation
     */
    public function deleteFormation($id)
    {
        Formation::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Formation supprimée.');
    }

    /**
     * Ajouter une compétence
     */
    public function addCompetence(Request $request)
    {
        $request->validate([
            'competence_id' => 'required|exists:competences,id',
            'niveau'        => 'required|in:debutant,intermediaire,avance,expert',
        ]);

        $user = auth()->user();

        if ($user->competences()->where('competence_id', $request->competence_id)->exists()) {
            return redirect()->back()->with('error', 'Cette compétence est déjà dans votre profil.');
        }

        $user->competences()->attach($request->competence_id, ['niveau' => $request->niveau]);

        return redirect()->back()->with('success', 'Compétence ajoutée.');
    }

    /**
     * Supprimer une compétence
     */
    public function deleteCompetence($id)
    {
        auth()->user()->competences()->detach($id);
        return redirect()->back()->with('success', 'Compétence supprimée.');
    }
}