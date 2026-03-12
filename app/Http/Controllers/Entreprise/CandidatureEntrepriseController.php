<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class CandidatureEntrepriseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'entreprise']);
    // }

    /**
     * Liste de toutes les candidatures reçues
     */
    public function index(Request $request)
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create');
        }

        $query = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->with(['offre', 'candidat']);

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par offre
        if ($request->filled('offre_id')) {
            $query->where('offre_id', $request->offre_id);
        }

        $candidatures = $query->latest()->paginate(15);

        // Offres pour le filtre
        $offres = $entreprise->offres()
            ->select('id', 'titre')
            ->get();

        return view('entreprise.candidatures.index', compact('candidatures', 'offres'));
    }

    /**
     * Candidatures pour une offre spécifique
     */
    public function offreCandidatures($offreId)
    {
        $entreprise = auth()->user()->entreprise;
        $offre = Offre::where('entreprise_id', $entreprise->id)
            ->with(['candidatures.candidat'])
            ->findOrFail($offreId);

        $candidatures = $offre->candidatures()
            ->with('candidat')
            ->latest()
            ->paginate(15);

        return view('entreprise.candidatures.offre', compact('offre', 'candidatures'));
    }

    /**
     * Voir le détail d'une candidature
     */
    public function show($id)
    {
        $entreprise = auth()->user()->entreprise;
        
        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->with(['offre', 'candidat.experiences', 'candidat.formations', 'candidat.competences'])
            ->findOrFail($id);

        // Marquer comme vue si en attente
        if ($candidature->isEnAttente()) {
            $candidature->marquerVue();
        }

        return view('entreprise.candidatures.show', compact('candidature'));
    }

    /**
     * Changer le statut d'une candidature
     */
    public function changeStatus($id, Request $request)
    {
        $entreprise = auth()->user()->entreprise;

        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->findOrFail($id);

        $request->validate([
            'statut' => 'required|in:vue,retenue,rejetee',
            'note_recruteur' => 'nullable|string|max:1000',
        ]);

        $candidature->update([
            'statut' => $request->statut,
            'note_recruteur' => $request->note_recruteur,
        ]);

        $messages = [
            'vue' => 'Candidature marquée comme vue.',
            'retenue' => 'Candidature retenue avec succès.',
            'rejetee' => 'Candidature rejetée.',
        ];

        return redirect()->back()->with('success', $messages[$request->statut]);
    }

    /**
     * Télécharger le CV d'un candidat
     */
    public function downloadCV($id)
    {
        $entreprise = auth()->user()->entreprise;

        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->findOrFail($id);

        if (!$candidature->cv_path) {
            return redirect()->back()->with('error', 'Aucun CV disponible pour cette candidature.');
        }

        return \Storage::disk('public')->download($candidature->cv_path);
    }
}