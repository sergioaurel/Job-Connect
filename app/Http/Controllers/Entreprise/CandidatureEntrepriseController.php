<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class CandidatureEntrepriseController extends Controller
{
    public function index(Request $request)
    {
        $entreprise = auth()->user()->entreprise;

        if (!$entreprise) {
            return redirect()->route('entreprise.profil.create');
        }

        $query = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->with(['offre', 'candidat']);

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('offre_id')) {
            $query->where('offre_id', $request->offre_id);
        }

        $candidatures = $query->latest()->paginate(15);

        $offres = $entreprise->offres()
            ->select('id', 'titre')
            ->get();

        return view('entreprise.candidatures.index', compact('candidatures', 'offres'));
    }

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

    public function show($id)
    {
        $entreprise = auth()->user()->entreprise;

        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->with(['offre', 'candidat.experiences', 'candidat.formations', 'candidat.competences'])
            ->findOrFail($id);

        if ($candidature->isEnAttente()) {
            $candidature->marquerVue();
        }

        return view('entreprise.candidatures.show', compact('candidature'));
    }

    public function changeStatus($id, Request $request)
    {
        $entreprise = auth()->user()->entreprise;

        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->findOrFail($id);

        $request->validate([
            'statut'         => 'required|in:vue,retenue,rejetee',
            'note_recruteur' => 'nullable|string|max:1000',
        ]);

        $candidature->update([
            'statut'         => $request->statut,
            'note_recruteur' => $request->note_recruteur,
        ]);

        $messages = [
            'vue'     => 'Candidature marquée comme vue.',
            'retenue' => 'Candidature retenue avec succès.',
            'rejetee' => 'Candidature rejetée.',
        ];

        return redirect()->back()->with('success', $messages[$request->statut]);
    }

    /**
     * Télécharger / visualiser le CV d'un candidat
     * Si le CV est sur Cloudinary (URL https), on redirige directement.
     * Si le CV est encore sur le storage local (ancienne candidature), on tente le download.
     */
public function downloadCV($id)
{
    $entreprise = auth()->user()->entreprise;

    $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
        ->findOrFail($id);

    if (!$candidature->cv_path) {
        return redirect()->back()->with('error', 'Aucun CV disponible pour cette candidature.');
    }

    // Si c'est une URL Cloudinary
    if (str_starts_with($candidature->cv_path, 'http')) {
        $content = file_get_contents($candidature->cv_path);
        
        if ($content === false) {
            return redirect()->back()->with('error', 'Impossible de télécharger le CV.');
        }

        return response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="cv.pdf"',
        ]);
    }

    return \Storage::disk('public')->download($candidature->cv_path);
}
}