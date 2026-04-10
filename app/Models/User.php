<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'localisation',
        'type_contrat_souhaite', // ← seul champ ajouté
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    // ═══════════════════════════════════════
    // RELATIONS
    // ═══════════════════════════════════════

    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'candidat_competence')
                    ->withPivot('niveau')
                    ->withTimestamps();
    }

    public function favoris()
    {
        return $this->belongsToMany(Offre::class, 'favoris')
                    ->withTimestamps();
    }

    // ═══════════════════════════════════════
    // MÉTHODES UTILITAIRES
    // ═══════════════════════════════════════

    public function isCandidat(): bool
    {
        return $this->role === 'candidat';
    }

    public function isEntreprise(): bool
    {
        return $this->role === 'entreprise';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function profilComplete(): bool
    {
        if (!$this->isCandidat()) return false;

        return $this->telephone
            && $this->localisation
            && $this->experiences()->count() > 0
            && $this->formations()->count() > 0
            && $this->competences()->count() > 0;
    }

    // ═══════════════════════════════════════
    // SYSTÈME DE RECOMMANDATION
    // Basé sur : formations enregistrées (diplôme + domaine)
    //            + localisation + type_contrat_souhaite
    // ═══════════════════════════════════════

    public function getRecommandations(int $limit = 6)
    {
        // Charger les formations et compétences si pas déjà fait
        if (!$this->relationLoaded('formations')) {
            $this->load('formations', 'competences');
        }

        // Extraire les domaines et diplômes des formations enregistrées
        $domaines   = $this->formations->pluck('domaine')->filter()->unique()->toArray();
        $diplomes   = $this->formations->pluck('diplome')->filter()->unique()->toArray();
        $competences = $this->competences->pluck('nom')->toArray();

        // Si aucune donnée de profil → retourner les plus récentes
        if (empty($domaines) && empty($diplomes) && empty($competences)
            && !$this->localisation && !$this->type_contrat_souhaite) {
            return Offre::with(['entreprise', 'categorie'])
                ->where('statut', 'active')
                ->latest()
                ->take($limit)
                ->get();
        }

        $query = Offre::with(['entreprise', 'categorie'])
            ->where('statut', 'active');

        // ── Critère 1 : Mots-clés domaine & diplôme dans titre/description ──
        if (!empty($domaines) || !empty($diplomes) || !empty($competences)) {
            $query->where(function ($q) use ($domaines, $diplomes, $competences) {

                // Domaines de formation
                foreach ($domaines as $domaine) {
                    // Extraire les mots significatifs du domaine
                    foreach (explode(' ', $domaine) as $mot) {
                        if (strlen($mot) > 4) {
                            $q->orWhere('titre', 'like', "%{$mot}%")
                              ->orWhere('description', 'like', "%{$mot}%")
                              ->orWhere('profil_recherche', 'like', "%{$mot}%")
                              ->orWhere('competences_requises', 'like', "%{$mot}%");
                        }
                    }
                }

                // Diplômes
                foreach ($diplomes as $diplome) {
                    $q->orWhere('niveau_etude', 'like', "%{$diplome}%")
                      ->orWhere('profil_recherche', 'like', "%{$diplome}%");
                }

                // Compétences
                foreach ($competences as $comp) {
                    $q->orWhere('competences_requises', 'like', "%{$comp}%")
                      ->orWhere('description', 'like', "%{$comp}%");
                }
            });
        }

        // ── Critère 2 : Type de contrat souhaité ──
        if ($this->type_contrat_souhaite) {
            if (in_array($this->type_contrat_souhaite, ['CDI', 'CDD', 'temps_partiel', 'freelance'])) {
                $query->where(function ($q) {
                    $q->where('type_contrat', $this->type_contrat_souhaite)
                      ->orWhere('type_offre', 'emploi');
                });
            } elseif ($this->type_contrat_souhaite === 'stage_professionnel') {
                $query->where('type_offre', 'stage_professionnel');
            } elseif ($this->type_contrat_souhaite === 'stage_academique') {
                $query->where('type_offre', 'stage_academique');
            }
        }

        // ── Critère 3 : Localisation ──
        if ($this->localisation) {
            $ville = trim(explode(',', $this->localisation)[0]);
            $query->where(function ($q) use ($ville) {
                $q->where('ville', 'like', "%{$ville}%")
                  ->orWhereNull('ville');
            });
        }

        return $query->latest()->take($limit)->get();
    }

    // ═══════════════════════════════════════
    // LISTES DE RÉFÉRENCE
    // ═══════════════════════════════════════

    public static function getVillesBenin(): array
    {
        return [
            'Cotonou', 'Porto-Novo', 'Parakou', 'Djougou', 'Bohicon',
            'Kandi', 'Lokossa', 'Ouidah', 'Abomey', 'Natitingou',
            'Malanville', 'Nikki', 'Savè', 'Pobè', 'Aplahoué',
            'Dassa-Zoumè', 'Comè', 'Bembèrèkè', 'Tchaourou', 'Bassila',
        ];
    }

    public static function getDiplomes(): array
    {
        return [
            'BEPC', 'BAC', 'BTS', 'DUT', 'Licence',
            'Licence Professionnelle', 'Bachelor', 'Master',
            'Master Professionnel', 'Ingénieur', 'MBA',
            'Doctorat', 'Certificat professionnel', 'Formation courte',
        ];
    }

    public static function getDomaines(): array
    {
        return [
            'Informatique & Développement',
            'Réseaux & Télécommunications',
            'Intelligence Artificielle & Data',
            'Marketing & Communication',
            'Commerce & Vente',
            'Comptabilité & Finance',
            'Gestion & Administration',
            'Ressources Humaines',
            'Droit & Juridique',
            'Santé & Médecine',
            'Éducation & Formation',
            'Ingénierie & BTP',
            'Agriculture & Environnement',
            'Logistique & Transport',
            'Hôtellerie & Restauration',
            'Art & Design',
            'Journalisme & Médias',
            'Banque & Assurance',
            'Énergie & Industries',
            'Autre',
        ];
    }

    public static function getTypesContratSouhaite(): array
    {
        return [
            'CDI'                 => 'CDI — Contrat à durée indéterminée',
            'CDD'                 => 'CDD — Contrat à durée déterminée',
            'temps_partiel'       => 'Temps partiel',
            'freelance'           => 'Freelance / Mission',
            'stage_professionnel' => 'Stage professionnel',
            'stage_academique'    => 'Stage académique',
        ];
    }
}