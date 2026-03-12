<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Categorie extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Configuration du slug
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nom'
            ]
        ];
    }

    // Relations

    /**
     * Offres de cette catégorie
     */
    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    // Méthodes utilitaires

    /**
     * Nombre d'offres actives dans cette catégorie
     */
    public function nombreOffresActives()
    {
        return $this->offres()->where('statut', 'active')->count();
    }
}