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
            'statut'           => 'required|in:en_attente,vue,retenue,rejetee', // ← en_attente ajouté
            'note_recruteur'  => 'nullable|string|max:2000',                   // ← notes avec s
        ]);

        $candidature->update([
            'statut'          => $request->statut,
            'note_recruteur' => $request->note_recruteur, // ← notes avec s
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
     * Protection SSRF : on valide que l'URL appartient bien à Cloudinary
     * avant tout appel réseau.
     */
    public function downloadCV($id)
    {
        $entreprise = auth()->user()->entreprise;

        $candidature = Candidature::whereIn('offre_id', $entreprise->offres->pluck('id'))
            ->findOrFail($id);

        if (!$candidature->cv_path) {
            return redirect()->back()->with('error', 'Aucun CV disponible pour cette candidature.');
        }

        // Si c'est une URL Cloudinary — validation stricte du domaine (anti-SSRF)
        if (str_starts_with($candidature->cv_path, 'http')) {
            $host = parse_url($candidature->cv_path, PHP_URL_HOST);

            // Autoriser uniquement les domaines officiels de Cloudinary
            $allowedHosts = ['res.cloudinary.com', 'api.cloudinary.com'];
            $isCloudinary = $host && (
                in_array($host, $allowedHosts) ||
                str_ends_with($host, '.cloudinary.com')
            );

            if (!$isCloudinary) {
                abort(403, 'Source du CV non autorisée.');
            }

            // Générer une URL signée via le SDK Cloudinary pour les ressources authentifiées
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            // Extraire le public_id depuis l'URL stockée
            $publicId = pathinfo(parse_url($candidature->cv_path, PHP_URL_PATH), PATHINFO_FILENAME);
            $folder   = 'job_connect/cvs';

            $signedUrl = $cloudinary->image("{$folder}/{$publicId}.pdf")
                ->toUrl(['sign_url' => true, 'expires_at' => time() + 300]);

            return redirect((string) $signedUrl);
        }

        return \Storage::disk('public')->download($candidature->cv_path);
    }
}