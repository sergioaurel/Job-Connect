<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    /**
     * Afficher le formulaire de candidature
     */
    public function create($offreId)
    {
        $offre = Offre::with('entreprise')->findOrFail($offreId);

        // Vérifier que c'est bien un candidat
        if (!auth()->user()->isCandidat()) {
            return redirect()->back()->with('error', 'Seuls les candidats peuvent postuler.');
        }

        // Vérifier si déjà postulé
        $dejaPostule = Candidature::where('offre_id', $offreId)
            ->where('user_id', auth()->id())
            ->exists();

        if ($dejaPostule) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        // Vérifier si l'offre est active
        if (!$offre->isActive()) {
            return redirect()->back()->with('error', 'Cette offre n\'est plus disponible.');
        }

        return view('candidatures.create', compact('offre'));
    }

    /**
     * Enregistrer une candidature
     */
    public function store(Request $request, $offreId)
    {
        $request->validate([
            'lettre_motivation' => 'required|string|min:100',
            'cv' => 'nullable|file|mimes:pdf|max:2048', // 2MB max
        ], [
            'lettre_motivation.required' => 'La lettre de motivation est obligatoire.',
            'lettre_motivation.min' => 'La lettre de motivation doit contenir au moins 100 caractères.',
            'cv.mimes' => 'Le CV doit être au format PDF.',
            'cv.max' => 'Le CV ne doit pas dépasser 2 Mo.',
        ]);

        $offre = Offre::findOrFail($offreId);

        // Vérifier que c'est un candidat
        if (!auth()->user()->isCandidat()) {
            return redirect()->back()->with('error', 'Seuls les candidats peuvent postuler.');
        }

        // Vérifier si déjà postulé
        $dejaPostule = Candidature::where('offre_id', $offreId)
            ->where('user_id', auth()->id())
            ->exists();

        if ($dejaPostule) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        // Upload du CV si fourni
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        // Créer la candidature
        Candidature::create([
            'offre_id' => $offreId,
            'user_id' => auth()->id(),
            'lettre_motivation' => $request->lettre_motivation,
            'cv_path' => $cvPath,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('candidat.candidatures')
            ->with('success', 'Votre candidature a été envoyée avec succès !');
    }

    /**
     * Ajouter/retirer une offre des favoris
     */
    public function toggleFavori($offreId)
    {
        $offre = Offre::findOrFail($offreId);

        if (!auth()->user()->isCandidat()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $user = auth()->user();

        if ($user->favoris()->where('offre_id', $offreId)->exists()) {
            // Retirer des favoris
            $user->favoris()->detach($offreId);
            $message = 'Offre retirée des favoris';
            $estFavori = false;
        } else {
            // Ajouter aux favoris
            $user->favoris()->attach($offreId);
            $message = 'Offre ajoutée aux favoris';
            $estFavori = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'estFavori' => $estFavori,
        ]);
    }
}