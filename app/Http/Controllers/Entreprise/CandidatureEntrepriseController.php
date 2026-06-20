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
            'statut'         => 'required|in:en_attente,vue,retenue,rejetee',
            'note_recruteur' => 'nullable|string|max:2000',
        ]);

        $candidature->update([
            'statut'         => $request->statut,
            'note_recruteur' => $request->note_recruteur,
        ]);

        $messages = [
            'en_attente' => 'Candidature remise en attente.',
            'vue'        => 'Candidature marquée comme vue.',
            'retenue'    => 'Candidature retenue avec succès.',
            'rejetee'    => 'Candidature rejetée.',
        ];

        return redirect()->back()->with('success', $messages[$request->statut]);
    }

    /**
     * Télécharger / visualiser le CV d'un candidat
     *
     * ── Sécurité ──
     * Le CV est uploadé sur Cloudinary en accès "public" (URL imprévisible,
     * pas indexée, jamais affichée nulle part dans l'app sauf ici).
     * La vraie protection vient d'AVANT cette ligne : whereIn('offre_id', ...)
     * garantit que seule l'entreprise propriétaire de l'offre peut arriver
     * jusqu'à cette redirection. On ne fait plus aucun appel au SDK Cloudinary
     * ici — juste une redirection directe vers l'URL stockée.
     *
     * Avantage : aucune dépendance à la signature du SDK qui change selon les
     * versions. Inconvénient mineur : si l'URL Cloudinary fuite, le fichier
     * est accessible sans passer par Laravel — acceptable pour un CV qui
     * n'est de toute façon pas une donnée hautement sensible.
     */
    public function downloadCV($id)
    {
        $entreprise = auth()->user()->entreprise;

        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->findOrFail($id);

        if (!$candidature->cv_path) {
            return redirect()->back()->with('error', 'Aucun CV disponible pour cette candidature.');
        }

        // Validation anti-SSRF : on s'assure que l'URL stockée pointe bien
        // vers un domaine Cloudinary avant de rediriger dessus.
        if (str_starts_with($candidature->cv_path, 'http')) {
            $host = parse_url($candidature->cv_path, PHP_URL_HOST);

            $allowedHosts = ['res.cloudinary.com', 'api.cloudinary.com'];
            $isCloudinary = $host && (
                in_array($host, $allowedHosts) ||
                str_ends_with($host, '.cloudinary.com')
            );

            if (!$isCloudinary) {
                abort(403, 'Source du CV non autorisée.');
            }

            // Redirection directe — pas d'appel au SDK, pas de signature à calculer.
            return redirect($candidature->cv_path);
        }

        return \Storage::disk('public')->download($candidature->cv_path);
    }
}