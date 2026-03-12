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
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relations

    /**
     * Si l'utilisateur est une entreprise
     */
    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }

    /**
     * Candidatures envoyées par le candidat
     */
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    /**
     * Expériences professionnelles du candidat
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Formations du candidat
     */
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    /**
     * Compétences du candidat (relation Many-to-Many)
     */
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'candidat_competence')
                    ->withPivot('niveau')
                    ->withTimestamps();
    }

    /**
     * Offres mises en favoris
     */
    public function favoris()
    {
        return $this->belongsToMany(Offre::class, 'favoris')
                    ->withTimestamps();
    }

    // Méthodes utilitaires

    /**
     * Vérifier si l'utilisateur est un candidat
     */
    public function isCandidat()
    {
        return $this->role === 'candidat';
    }

    /**
     * Vérifier si l'utilisateur est une entreprise
     */
    public function isEntreprise()
    {
        return $this->role === 'entreprise';
    }

    /**
     * Vérifier si l'utilisateur est un admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifier si le profil candidat est complet
     */
    public function profilComplete()
    {
        if (!$this->isCandidat()) {
            return false;
        }

        return $this->telephone 
            && $this->localisation 
            && $this->experiences()->count() > 0 
            && $this->formations()->count() > 0 
            && $this->competences()->count() > 0;
    }
}