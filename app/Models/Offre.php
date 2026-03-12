<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Offre extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'entreprise_id',
        'categorie_id',
        'titre',
        'slug',
        'type_offre',
        'type_contrat',
        'description',
        'missions',
        'profil_recherche',
        'competences_requises',
        'niveau_etude',
        'annees_experience',
        'ville',
        'salaire_min',
        'salaire_max',
        'salaire_a_negocier',
        'nombre_postes',
        'date_limite',
        'statut',
        'vues',
    ];

    protected $casts = [
        'date_limite' => 'date',
        'salaire_a_negocier' => 'boolean',
        'annees_experience' => 'integer',
        'nombre_postes' => 'integer',
        'vues' => 'integer',
    ];

    /**
     * Configuration du slug
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'titre'
            ]
        ];
    }

    // Relations

    /**
     * Entreprise qui a publié l'offre
     */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    /**
     * Catégorie de l'offre
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Candidatures reçues pour cette offre
     */
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    /**
     * Candidats ayant mis cette offre en favori
     */
    public function favorisePar()
    {
        return $this->belongsToMany(User::class, 'favoris')
                    ->withTimestamps();
    }

    // Méthodes utilitaires

    /**
     * Incrémenter le nombre de vues
     */
    public function incrementerVues()
    {
        $this->increment('vues');
    }

    /**
     * Vérifier si l'offre est active
     */
    public function isActive()
    {
        return $this->statut === 'active';
    }

    /**
     * Vérifier si la date limite est dépassée
     */
    public function isExpiree()
    {
        return $this->date_limite && $this->date_limite->isPast();
    }

    /**
     * Vérifier si c'est un emploi
     */
    public function isEmploi()
    {
        return $this->type_offre === 'emploi';
    }

    /**
     * Vérifier si c'est un stage
     */
    public function isStage()
    {
        return in_array($this->type_offre, ['stage_professionnel', 'stage_academique']);
    }

    /**
     * Nombre de candidatures reçues
     */
    public function nombreCandidatures()
    {
        return $this->candidatures()->count();
    }

    /**
     * Candidatures en attente
     */
    public function candidaturesEnAttente()
    {
        return $this->candidatures()->where('statut', 'en_attente');
    }

    /**
     * Candidatures retenues
     */
    public function candidaturesRetenues()
    {
        return $this->candidatures()->where('statut', 'retenue');
    }
}