<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Categorie;
use App\Models\Entreprise;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        $stats = [
            'total_offres'      => Offre::where('statut', 'active')->count(),
            'total_entreprises' => Entreprise::where('statut', 'validee')->count(),
            'total_stages'      => Offre::whereIn('type_offre', ['stage_professionnel', 'stage_academique'])
                                        ->where('statut', 'active')
                                        ->count(),
        ];

        $dernieresOffres = Offre::with(['entreprise', 'categorie'])
            ->where('statut', 'active')
            ->latest()
            ->take(6)
            ->get();

        $categories = Categorie::withCount(['offres' => function ($query) {
                $query->where('statut', 'active');
            }])
            ->where('is_active', true)
            ->get()
            ->filter(fn($c) => $c->offres_count > 0)
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
     * Page Contact — affichage
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Page Contact — traitement du formulaire
     */
    public function contactSend(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|min:2|max:100',
            'email'   => 'required|email|max:150',
            'sujet'   => 'required|string|max:100',
            'message' => 'required|string|min:10|max:1000',
        ], [
            'name.required'    => 'Le nom est obligatoire.',
            'name.min'         => 'Le nom doit contenir au moins 2 caractères.',
            'email.required'   => "L'adresse email est obligatoire.",
            'email.email'      => "L'adresse email n'est pas valide.",
            'sujet.required'   => 'Veuillez choisir un sujet.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit contenir au moins 10 caractères.',
        ]);

        // Envoi de l'email à l'équipe JobConnect
        Mail::to('contact@jobconnect.bj')->send(new ContactMail($validated));

        return redirect()->route('contact')
            ->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les 24 heures.');
    }
}