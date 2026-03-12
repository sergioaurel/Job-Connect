<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poste',
        'entreprise',
        'ville',
        'date_debut',
        'date_fin',
        'en_cours',
        'description',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];

    // Relations

    /**
     * Candidat propriétaire de l'expérience
     */
    public function candidat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Méthodes utilitaires

    /**
     * Calculer la durée de l'expérience
     */
    public function duree()
    {
        $fin = $this->en_cours ? now() : $this->date_fin;
        return $this->date_debut->diffInMonths($fin);
    }

    /**
     * Format d'affichage de la période
     */
    public function periode()
    {
        $debut = $this->date_debut->format('m/Y');
        $fin = $this->en_cours ? 'Présent' : $this->date_fin->format('m/Y');
        
        return "$debut - $fin";
    }
}