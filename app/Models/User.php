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
        'type_contrat_souhaite',
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
    // ═══════════════════════════════════════

    public function getRecommandations(int $limit = 6): array
    {
        if (!$this->relationLoaded('formations')) {
            $this->load('formations');
        }

        $diplomes = $this->formations->pluck('diplome')->filter()->unique()->toArray();
        $estStage = in_array($this->type_contrat_souhaite, ['stage_academique', 'stage_professionnel']);
        $ville    = $this->localisation ? trim(explode(',', $this->localisation)[0]) : null;

        // Si aucun critère → offres récentes
        if (empty($diplomes) && !$this->localisation && !$this->type_contrat_souhaite) {
            return [
                'offres'  => Offre::with(['entreprise', 'categorie'])->where('statut', 'active')->latest()->take($limit)->get(),
                'message' => null,
            ];
        }

        // Filtre type contrat — uniquement stages désormais
        $appliquerTypeContrat = function ($q) {
            if (!$this->type_contrat_souhaite) return;
            if ($this->type_contrat_souhaite === 'stage_academique') {
                $q->where('type_offre', 'stage_academique');
            } elseif ($this->type_contrat_souhaite === 'stage_professionnel') {
                $q->where('type_offre', 'stage_professionnel');
            }
        };

        // Filtre diplôme — désactivé pour les stages
        $appliquerDiplome = function ($q) use ($diplomes, $estStage) {
            if (!empty($diplomes) && !$estStage) {
                $q->where(function ($q2) use ($diplomes) {
                    foreach ($diplomes as $diplome) {
                        $q2->orWhere('niveau_etude', 'like', "%{$diplome}%")
                           ->orWhere('profil_recherche', 'like', "%{$diplome}%");
                    }
                });
            }
        };

        // ── Tentative 1 : tous les critères ──
        $q1 = Offre::with(['entreprise', 'categorie'])->where('statut', 'active');
        $appliquerDiplome($q1);
        $appliquerTypeContrat($q1);
        if ($ville) {
            $q1->where(fn($q) => $q->where('ville', 'like', "%{$ville}%")->orWhereNull('ville'));
        }
        $offres = $q1->latest()->take($limit)->get();
        if ($offres->isNotEmpty()) {
            return ['offres' => $offres, 'message' => null];
        }

        // ── Tentative 2 : sans la localisation ──
        $q2 = Offre::with(['entreprise', 'categorie'])->where('statut', 'active');
        $appliquerDiplome($q2);
        $appliquerTypeContrat($q2);
        $offres = $q2->latest()->take($limit)->get();
        if ($offres->isNotEmpty()) {
            $typeLabel = $this->type_contrat_souhaite
                ? self::getTypesContratSouhaite()[$this->type_contrat_souhaite] ?? $this->type_contrat_souhaite
                : 'ces offres';
            return [
                'offres'  => $offres,
                'message' => "Aucune offre de type « {$typeLabel} » disponible à {$ville} pour le moment. Voici les offres disponibles dans d'autres villes.",
            ];
        }

        // ── Tentative 3 : uniquement le type contrat ──
        if ($this->type_contrat_souhaite) {
            $q3 = Offre::with(['entreprise', 'categorie'])->where('statut', 'active');
            $appliquerTypeContrat($q3);
            $offres = $q3->latest()->take($limit)->get();
            if ($offres->isNotEmpty()) {
                $typeLabel = self::getTypesContratSouhaite()[$this->type_contrat_souhaite] ?? $this->type_contrat_souhaite;
                return [
                    'offres'  => $offres,
                    'message' => "Aucune offre correspondant exactement à votre profil n'a été trouvée. Voici les offres de type « {$typeLabel} » disponibles.",
                ];
            }
        }

        // ── Fallback final ──
        return [
            'offres'  => Offre::with(['entreprise', 'categorie'])->where('statut', 'active')->latest()->take($limit)->get(),
            'message' => "Aucune offre ne correspond exactement à votre profil. Voici les offres les plus récentes.",
        ];
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

    // ── Uniquement les deux types de stage ──
    public static function getTypesContratSouhaite(): array
    {
        return [
            'stage_professionnel' => 'Stage professionnel',
            'stage_academique'    => 'Stage académique',
        ];
    }
}