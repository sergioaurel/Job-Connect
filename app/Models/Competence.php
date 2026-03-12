<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
    ];

    // Relations

    /**
     * Candidats possédant cette compétence
     */
    public function candidats()
    {
        return $this->belongsToMany(User::class, 'candidat_competence')
                    ->withPivot('niveau')
                    ->withTimestamps();
    }

    // Méthodes utilitaires

    /**
     * Vérifier si c'est une compétence technique
     */
    public function isTechnique()
    {
        return $this->type === 'technique';
    }

    /**
     * Vérifier si c'est une compétence transversale
     */
    public function isTransversale()
    {
        return $this->type === 'transversale';
    }
}