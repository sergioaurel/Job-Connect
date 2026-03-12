<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'diplome',
        'etablissement',
        'domaine',
        'annee_obtention',
        'description',
    ];

    protected $casts = [
        'annee_obtention' => 'integer',
    ];

    // Relations

    /**
     * Candidat propriétaire de la formation
     */
    public function candidat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}