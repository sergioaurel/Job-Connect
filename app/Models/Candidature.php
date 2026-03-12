<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'offre_id',
        'user_id',
        'lettre_motivation',
        'cv_path',
        'statut',
        'note_recruteur',
        'vue_le',
    ];

    protected $casts = [
        'vue_le' => 'datetime',
    ];

    // Relations

    /**
     * Offre à laquelle le candidat postule
     */
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    /**
     * Candidat qui postule
     */
    public function candidat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Méthodes utilitaires

    /**
     * Marquer la candidature comme vue
     */
    public function marquerVue()
    {
        if ($this->statut === 'en_attente') {
            $this->update([
                'statut' => 'vue',
                'vue_le' => now(),
            ]);
        }
    }

    /**
     * Vérifier si la candidature est en attente
     */
    public function isEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Vérifier si la candidature est retenue
     */
    public function isRetenue()
    {
        return $this->statut === 'retenue';
    }

    /**
     * Vérifier si la candidature est rejetée
     */
    public function isRejetee()
    {
        return $this->statut === 'rejetee';
    }
}