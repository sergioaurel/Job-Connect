<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Entreprise extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'nom_entreprise',
        'slug',
        'description',
        'logo',
        'secteur_activite',
        'site_web',
        'adresse',
        'ville',
        'telephone_entreprise',
        'effectif',
        'annee_creation',
        'statut',
    ];

    protected $casts = [
        'annee_creation' => 'integer',
        'effectif' => 'integer',
    ];

    /**
     * Configuration du slug
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nom_entreprise'
            ]
        ];
    }

    // Relations

    /**
     * Utilisateur propriétaire de l'entreprise
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Offres publiées par l'entreprise
     */
    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    // Méthodes utilitaires

    /**
     * Vérifier si l'entreprise est validée
     */
    public function isValidee()
    {
        return $this->statut === 'validee';
    }

    /**
     * Vérifier si l'entreprise est en attente
     */
    public function isEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Vérifier si l'entreprise est suspendue
     */
    public function isSuspendue()
    {
        return $this->statut === 'suspendue';
    }

    /**
     * Nombre total de candidatures reçues
     */
    public function totalCandidatures()
    {
        return Candidature::whereIn('offre_id', $this->offres->pluck('id'))->count();
    }

    /**
     * Offres actives de l'entreprise
     */
    public function offresActives()
    {
        return $this->offres()->where('statut', 'active');
    }
}